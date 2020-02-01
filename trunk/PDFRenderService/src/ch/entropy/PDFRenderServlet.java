/*
 * 
 * Written by Marc Liyanage <http://www.entropy.ch>
 * 
 * http://localhost:9006/pdfrenderservice/get-pdf/nab2005.pdf?fullname=Marc+Liyanage&barcode_value=000000000125&barcode_string=MARCLIYANAGE&document=NAB-ticket-kl989.svg
 */
package ch.entropy;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.FactoryConfigurationError;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.TransformerConfigurationException;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.Transformer;
import javax.xml.transform.Templates;
import javax.xml.transform.dom.DOMResult;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamSource;
import javax.xml.transform.stream.StreamResult;

import java.io.*;
import java.util.HashMap;
import java.util.Map;
import java.util.StringTokenizer;

import org.apache.batik.transcoder.Transcoder;
import org.apache.batik.transcoder.TranscoderException;
import org.apache.batik.transcoder.TranscoderInput;
import org.apache.batik.transcoder.TranscoderOutput;

import org.apache.fop.svg.PDFTranscoder;
import org.w3c.dom.Document;
import org.xml.sax.SAXException;

import javax.crypto.spec.IvParameterSpec;
import javax.crypto.Cipher;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.lang.Exception;
import java.net.URLDecoder;

import javax.crypto.spec.SecretKeySpec;
import javax.crypto.SecretKey;
import java.io.IOException;
/**
 * @author liyanage
 *
 * TODO To change the template for this generated type comment go to
 * Window - Preferences - Java - Code Style - Code Templates
 */
public class PDFRenderServlet extends HttpServlet {

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	Templates templ;
	HashMap sourceDocuments;
	//DOMSource source;
	String fontpath;
	
	public void init() {

		System.setProperty("java.awt.headless", "true");
		sourceDocuments = new HashMap();
		try {
			setupStylesheet();
//			setupInputDocument();
		} catch (Exception e) {
			log(e.toString());
		}
				
	}

	public void setupStylesheet() throws TransformerConfigurationException, ServletException {

		ServletContext sc = getServletContext();

		StreamSource ss = new StreamSource(new File(sc.getRealPath(sc.getInitParameter("xslt-path"))));
		TransformerFactory tf = TransformerFactory.newInstance();
		templ = tf.newTemplates(ss);
		if (templ == null) {
			throw new ServletException("Unable to create XSLT Template");
		}
		
		fontpath = sc.getRealPath(sc.getInitParameter("font-path"));
		
	}
	
	
	
	
	
	/*
	public void setupInputDocument() throws SAXException, IOException, ParserConfigurationException {

		DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
		dbf.setNamespaceAware(true);
		Document doc = dbf.newDocumentBuilder().parse(getServletContext().getResourceAsStream(getServletContext().getInitParameter("template-path")));
		source = new DOMSource(doc);
		
	}
	*/
	
	protected void doGet(HttpServletRequest req, HttpServletResponse resp)
	throws ServletException, IOException {
	
		try {
			renderPDF(req, resp);
		} catch (Exception e) {
			log(e.toString());
			e.printStackTrace();
		}
	
	}

	
	private void renderPDF(HttpServletRequest req, HttpServletResponse resp)
		throws FactoryConfigurationError, SAXException, IOException, ParserConfigurationException, TransformerException, ServletException {

		Transcoder t = new PDFTranscoder();
		Document doc = getPersonalizedDoc(req);

		TranscoderInput input = new TranscoderInput(doc);
		OutputStream ostream = resp.getOutputStream();
		TranscoderOutput output = new TranscoderOutput(ostream);

		resp.setContentType("application/pdf");

		try {
			t.transcode(input, output);
		} catch (TranscoderException e) {
			log(e.toString());
			e.printStackTrace();
		}

		ostream.flush();

	}
	



	private synchronized Document getPersonalizedDoc(HttpServletRequest req) throws SAXException, IOException, ParserConfigurationException, TransformerException, ServletException {

		Transformer t = templ.newTransformer();

		Map values = getValues(req);
		
		String barcode_value = getValue(values, "barcode_value");
		String barcode_string = getValue(values, "barcode_string") == null ? barcode_value : getValue(values, "barcode_string");
		String documentName = getValue(values, "document");
		if (documentName == null) {
			throw new ServletException("document request parameter is missing");
		}
		String type = getValue(values, "type") == null ? "" : getValue(values, "type");
		
		t.setParameter("barcode_value", barcode_value);
		t.setParameter("barcode_string", barcode_string);
		t.setParameter("type", type);
		t.setParameter("fontpath", fontpath);

		t.setParameter("fullname", getValue(values, "fullname"));
		t.setParameter("company", getValue(values, "company"));
		
		if (true) {
//		if (!sourceDocuments.containsKey(documentName)) {
			log("document " + documentName + " unknown, loading");
			DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
			dbf.setNamespaceAware(true);
			Document doc = dbf.newDocumentBuilder().parse(getServletContext().getResourceAsStream(getServletContext().getInitParameter("template-path") + "/" + documentName));
			sourceDocuments.put(documentName, new DOMSource(doc));
		} else {
			log("document " + documentName + " already loaded");
		}
		
		
		DOMResult result = new DOMResult();
		t.transform((DOMSource)sourceDocuments.get(documentName), result);

		String dumpFilename = getServletContext().getInitParameter("svg-dump-filename"); 
		if (dumpFilename != null && dumpFilename.length() > 0) {
			DOMSource ds = new DOMSource((Document)result.getNode());
			Transformer dumpTransformer = TransformerFactory.newInstance().newTransformer();
			StreamResult sr = new StreamResult(new File(dumpFilename));
			dumpTransformer.transform(ds, sr);
		}

		return (Document)result.getNode();
	
	}

	
	String getValue(Map values, String key) {
		String [] value = (String [])values.get(key);
		if (value == null) return null;
		return value[0];
	}


	private Map getValues(HttpServletRequest req) throws ServletException {

		String encryptedParams = req.getParameter("data");
		if (encryptedParams == null) {
			return req.getParameterMap();
		}

		String decryptedParams = decryptParams(encryptedParams);
		return parameterString2Map(decryptedParams);
		
	}
	

	
	private String decryptParams(String hexBytes) throws ServletException {
		// From http://www.propaso.com/blog/2007/01/27/aes-interop-between-php-and-java/#comment-5
		byte[] outText = null;
		try {
			Cipher cipher = Cipher.getInstance("AES/CBC/NoPadding");
			SecretKeySpec keySpec = new SecretKeySpec("Rf4RQ5zD2LqjbmVQ".getBytes(), "AES");
			IvParameterSpec ivSpec = new IvParameterSpec("6Uhx6YhujT4FhdJS".getBytes());
			cipher.init(Cipher.DECRYPT_MODE, keySpec, ivSpec);
			outText = cipher.doFinal(hexToBytes(hexBytes));
		} catch (Exception e) {
			throw new ServletException(e);
		}
		return new String(outText).trim();
	}

	
	private static byte[] hexToBytes(String str) {
		if (str==null) {
			return null;
		} else if (str.length() < 2) {
			return null;
		} else {
			int len = str.length() / 2;
			byte[] buffer = new byte[len];
			for (int i=0; i<len; i++) {
				buffer[i] = (byte) Integer.parseInt(str.substring(i*2,i*2+2),16);
			}
			return buffer;
		}
	}
	
	private Map parameterString2Map(String s) {
		// From http://forum.java.sun.com/thread.jspa?threadID=753510&messageID=4305631
		StringTokenizer st = new StringTokenizer(s, "&=", true);
		HashMap m = new HashMap();
		String previous = null;
		while (st.hasMoreTokens()) {
			String current = st.nextToken();
			if (current.equals("&")) {
				//ignore
			} else if ("=".equals(current)) {
				m.put(URLDecoder.decode(previous), new String[] {URLDecoder.decode(st.nextToken())});
			} else {
				previous = current;
			}
		}
		return m;
		
	}
	
}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}
//-->
</script>
<?php
	include('includes/metadata.inc');
?>
<body bgcolor="#ffffff">
<!-- START NAV BAR TABLE --> 
<div id="tabs"> 
<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0"> 
    <TR> 
        <TD WIDTH="49%" VALIGN="TOP" BACKGROUND="http://images.apple.com/t/2002/us/en/i/1bg.gif"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1bg.gif" WIDTH="1" HEIGHT="52" ALT="" ALIGN="RIGHT" BORDER="0"></TD> 
        <TD WIDTH="2%" VALIGN="TOP" ALIGN="CENTER"> 
        <TABLE WIDTH="725" BORDER="0" CELLPADDING="0" CELLSPACING="0"> 
            <TR> 
                <TD WIDTH="725" VALIGN="TOP"><A HREF="http://www.apple.com/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.gif" WIDTH="118" HEIGHT="32" ALT="Apple" BORDER="0"></A><A HREF="http://www.apple.com/store/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/2.gif" WIDTH="98" HEIGHT="32" ALT="The Apple Store" BORDER="0"></A><A HREF="http://www.apple.com/itunes/" target="_top"><IMG SRC="http://images.apple.com/t/2003/us/en/i/3.gif" WIDTH="98" HEIGHT="32" ALT="iPod+iTunes" BORDER="0"></A><A HREF="http://www.mac.com/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/4.gif" WIDTH="98" HEIGHT="32" ALT=".Mac" BORDER="0"></A><A HREF="http://www.apple.com/quicktime/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/5.gif" WIDTH="98" HEIGHT="32" ALT="QuickTime" BORDER="0"></A><A HREF="http://www.apple.com/support/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/6.gif" WIDTH="98" HEIGHT="32" ALT="Apple Support" BORDER="0"></A><A HREF="http://www.apple.com/macosx/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/7.gif" WIDTH="117" HEIGHT="32" BORDER="0" ALT="Mac OS X"></A></TD> 
            </TR> 
            <TR> 
                <TD WIDTH="725" VALIGN="TOP"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1left.gif" WIDTH="21" HEIGHT="20" BORDER="0" ALT=""><A HREF="http://www.apple.com/hotnews/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1a.gif" WIDTH="71" HEIGHT="20" BORDER="0" ALT="Hot News"></A><A HREF="http://www.apple.com/switch/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1b.gif" WIDTH="55" HEIGHT="20" BORDER="0" ALT="Switch"></A><A HREF="http://www.apple.com/hardware/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1c.gif" WIDTH="71" HEIGHT="20" BORDER="0" ALT="Hardware"></A><A HREF="http://www.apple.com/software/" target="_top"><IMG WIDTH="66" SRC="http://images.apple.com/t/2002/us/en/i/1.1dhi.gif" ALT="Software" HEIGHT="20" BORDER="0"></A><A HREF="http://www.apple.com/guide/us/" target="_top"><IMG WIDTH="78" SRC="http://images.apple.com/t/2002/us/en/i/1.1e.gif" ALT="Made4Mac" HEIGHT="20" BORDER="0"></A><A HREF="http://www.apple.com/education/" target="_top"><IMG WIDTH="72" SRC="http://images.apple.com/t/2002/us/en/i/1.1f.gif" ALT="Education" HEIGHT="20" BORDER="0"></A><A HREF="http://www.apple.com/pro/" target="_top"><IMG WIDTH="38" SRC="http://images.apple.com/t/2002/us/en/i/1.1g.gif" ALT="Pro" HEIGHT="20" BORDER="0"></A><A HREF="http://www.apple.com/business/" target="_top"><IMG WIDTH="65" SRC="http://images.apple.com/t/2002/us/en/i/1.1h.gif" ALT="business" HEIGHT="20" BORDER="0"></A><A HREF="http://www.apple.com/developer/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1i.gif" HEIGHT="20" WIDTH="75" ALT="Developer"BORDER="0"></A><A HREF="http://www.apple.com/buy/" target="_top"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1j.gif" WIDTH="91" HEIGHT="20" BORDER="0" ALT="Where to Buy"></A><IMG SRC="http://images.apple.com/t/2002/us/en/i/1.1right.gif" WIDTH="22" HEIGHT="20" BORDER="0" ALT=""></TD> 
            </TR>  
        </TABLE> 
        </TD> 
        <TD WIDTH="49%" VALIGN="TOP" BACKGROUND="http://images.apple.com/t/2002/us/en/i/1bg.gif"><IMG SRC="http://images.apple.com/t/2002/us/en/i/1bg.gif" WIDTH="1" HEIGHT="52" ALT="" ALIGN="LEFT" BORDER="0"></TD> 
    </TR> 
</TABLE> 
</div> 
<!-- END NAV BAR TABLE -->
<br>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/NAB2005Header.gif" alt="Pro Digital Productions" width="698" height="41" border="0"></td>
  </tr>
</table>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" background="images/pronavleft_041804.gif"><img src="images/pronavleft_041804.gif" width="10" height="1"></td>
    <td bgcolor="#ffffff"><form name="form1" method="post" action="thankyou.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td colspan="2"><p><span class="hi" style="font-size: 30px">Apple Registration</span></p>
                </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="40%"><span style="font-weight: bold">First Name</span> <span class="sosumi">(required)</span> <br>
                <input name="chrFirst" type="text" id="chrFirst" size="30" maxlength="30"> </td>
              <td width="50%"><span style="font-weight: bold">Last Name</span> <span class="sosumi">(required)</span> <br>
                <input name="chrLast" type="text" id="chrLast" size="30" maxlength="30"></td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Company Name</span> <span class="sosumi">(required)</span> <br>
                <input name="chrCompany" type="text" id="chrCompany" size="45" maxlength="50"></td>
            </tr>
            <tr>
              <td colspan="2"><p><span style="font-weight: bold">Title</span> <span class="sosumi">(required)</span> <br>
                  <input name="chrTitle" type="text" id="chrTitle" size="45" maxlength="50">
              </p>
                </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Email Address</span> (Confirmation will be sent to this address.)<br>
                <input name="chrEmail" type="text" id="chrEmail" size="45" maxlength="40"></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr bgcolor="#f2f2f2">
              <td colspan="2"><input name="chrContact" type="checkbox" id="chrContact" value="Yes" checked>
Stay in touch! Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products. </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><input name="Submit" type="submit" onClick="YY_checkform('form1','chrFirst','#q','0','Please enter your First Name.','chrLast','#q','0','Please enter your Last Name.','chrCompany','#q','0','Please enter your Company Name.','chrTitle','#q','0','Please enter your Title.','chrEmail','#q','0','Please enter your Email Address.');return document.MM_returnValue" value="Submit">
                <input name="idType" type="hidden" id="idType" value="2"></td>
            </tr>
            <tr>
              <td colspan="2"><a href="http://www.apple.com/legal/privacy/">Apple Privacy Policy</a><br>
You're in control. You always have access to your personal information and contact preferences, so you can change them at any time. To learn how Apple safeguards your personal information, please review the Apple Customer Privacy Policy. &nbsp;If you would rather not receive this information, please uncheck the box.</td>
            </tr>
          </table>          </td>
        </tr>
      </table>
      </form>    </td>
    <td width="10" background="images/pronavright_041804.gif"><img src="images/pronavright_041804.gif" width="10" height="1"></td>
  </tr>
</table>

<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/pronavbottom_041804.gif" width="698" height="24"></td>
  </tr>
</table>
<!-- START INCLUDED FOOTER --> 
<!-- START SEARCH --> 
<div id="footer"> 
<form method="post" action="http://searchcgi.apple.com/cgi-bin/sp/nph-searchpre1.pl"> 
<input type="hidden" name="client" value="www_collection"> 
<input type="hidden" name="access" value="p"> 
<input type="hidden" name="lr" value="lang_en"> 
<input type="hidden" name="subcol" value="us_only"> 
<input name="q" type="text" size="25"> 
<input type="submit" value="Search" name=btnG><br> 
<A HREF="http://www.apple.com/find/sitemap.html" target="_top">Site Map</a>&nbsp;|&nbsp;<A HREF="http://www.apple.com/find/searchtips.html" target="_top">Search Tips</a> 
</form> 
<!-- END SEARCH --> 
<p>Visit the Apple Store <A HREF="http://www.apple.com/store/" target="_top">online</a> or at <A HREF="http://www.apple.com/retail/" target="_top">retail</a> locations.<br> 
1-800-MY-APPLE</p> 
<p><A HREF="http://www.apple.com/contact/" target="_top">Contact Us</a>&nbsp;|&nbsp;<A HREF="http://www.apple.com/legal/" target="_top">Terms of Use</a>&nbsp;|&nbsp;<A HREF="http://www.apple.com/legal/privacy/" target="_top">Privacy Policy</a></p> 
</div> 
<p class="sosumi">Copyright &copy; 2005 Apple Computer, Inc. All rights reserved.</p> 
<!-- END INCLUDED FOOTER -->
</body>
</html>

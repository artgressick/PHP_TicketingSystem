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
              <td colspan="2"><p><span class="hi" style="font-size: 30px">Apple Registration</span><br>
                </p>
                </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="50%"><span style="font-weight: bold">First Name</span>                  <span class="sosumi">(required)</span><br>                  <input name="chrFirst" type="text" id="chrFirst" size="30" maxlength="30">                  </td>
              <td width="50%"><span style="font-weight: bold">Last Name</span> <span class="sosumi">(required) </span><br>                  
                <input name="chrLast" type="text" id="chrLast" size="30" maxlength="30">                  </td>
            </tr>
            <tr>
              <td><span style="font-weight: bold">Company Name</span> <span class="sosumi">(required) </span><br>                  <input name="chrCompany" type="text" id="chrCompany" size="30" maxlength="50">                  </td>
              <td><span style="font-weight: bold">Title</span> <span class="sosumi">(required)</span> <br>                  <input name="chrTitle" type="text" id="chrTitle" size="30" maxlength="50">              </td>
            </tr>
            <tr>
              <td colspan="2"><p><span style="font-weight: bold">Address</span> <span class="sosumi">(required)</span> <br>
                <input name="chrAddress1" type="text" id="chrAddress1" size="45" maxlength="50">
                      <br>
                      <input name="chrAddress2" type="text" id="chrAddress2" size="45" maxlength="50">
                      <br>
                      <input name="chrAddress3" type="text" id="chrAddress3" size="45" maxlength="50">
                  </p>                </td>
              </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Town/City</span> <span class="sosumi">(required)</span> <br>                  <input name="chrCity" type="text" id="chrCity" size="40" maxlength="50">              </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">State/Province</span><br>                  <input name="chrState" type="text" id="chrState" size="4" maxlength="2"> 
              (US/Canada only) </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Postal Code</span> <span class="sosumi">(required)</span><br>                  <input name="chrPostalCode" type="text" id="chrPostalCode" size="30" maxlength="20">              </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Country</span> <span class="sosumi">(required)</span> <br>                  <select name="chrCountry" size="1" id="chrCountry">
                      <option value="0" selected>Select Country</option>
                      <option value="United States">United States</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antarctica">Antarctica</option>
                      <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                      <option value="Brunei Darussalam">Brunei Darussalam</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Canary Islands">Canary Islands</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comorian">Comorian</option>
                      <option value="Congo">Congo</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">French Southern Territories</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia, Republic of">Georgia, Republic of</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guernsey">Guernsey</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard And Mc Donald Islands">Heard And Mc Donald Islands</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jersey">Jersey</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea, Republic Of">Korea, Republic Of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao People'S Democratic R. Of">Lao People'S Democratic R. Of</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia">Micronesia</option>
                      <option value="Moldova, Republic of">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">Netherlands Antilles</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Palestinian Territory">Palestinian Territory</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russian Federation">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="S Georgia &amp; The S Sandwich Isl">S Georgia &amp; The S Sandwich Isl</option>
                      <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                      <option value="Saint Lucia">Saint Lucia</option>
                      <option value="Saint Vincent &amp; The Grenadines">Saint Vincent &amp; The Grenadines</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome And Principe">Sao Tome And Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Scotland">Scotland</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="St. Helena">St. Helena</option>
                      <option value="St. Pierre And Miquelon">St. Pierre And Miquelon</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Taiwan">Taiwan</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania, United Republic Of">Tanzania, United Republic Of</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying">United States Minor Outlying</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Viet Nam">Viet Nam</option>
                      <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                      <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                      <option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Yugoslavia">Yugoslavia</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>              </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Phone Number</span> <span class="sosumi">(required)</span><br>                  <input name="chrPhone" type="text" id="chrPhone" size="30" maxlength="25">
                  (ex. 408-555-1212 or 44-182-726-0715) </td>
            </tr>
            <tr>
              <td colspan="2"><p><span style="font-weight: bold">Email Address</span> (Confirmation will be sent to this address.) <br>
                <input name="chrEmail" type="text" id="chrEmail" size="45" maxlength="40"> 
                  </p>
                </td>
            </tr>
            <tr>
              <td height="35" colspan="2"><hr align="left" width="100%" size="1"></td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Organization Type<br>                  
                  <select name="Q1" size="1" id="Q1">
                      <option value="0" selected>Please choose</option>
                      <option value="Creative Professional">Creative Professional</option>
                      <option value="Business">Business</option>
                      <option value="Government">Government</option>
                      <option value="Non-Profit">Non-Profit</option>
                      <option value="Education">Education</option>
                      <option value="Personal">Personal</option>
                      <option value="Reseller">Reseller</option>
                      <option value="Other">Other</option>
                  </select>
              </span></td>
            </tr>
            <tr>
              <td colspan="2"><p style="font-weight: bold">Organization Size<br>
                <select name="Q2" size="1" id="Q2">
                  <option value="0" selected>Please choose</option>
                  <option value="1">1</option>
                  <option value="2 to 4">2 to 4</option>
                  <option value="5 to 19">5 to 19</option>
                  <option value="20 to 49">20 to 49</option>
                  <option value="50 to 99">50 to 99</option>
                  <option value="100 to 499">100 to 499</option>
                  <option value="500 to 999">500 to 999</option>
                  <option value="1000+">1000+</option>
                  </select> 
                  </p>
                </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-weight: bold">Primary Job Function<br>                  
                  <select name="Q3" size="1" id="Q3">
                      <option value="0" selected>Please choose</option>
                      <option value="Executive/Corporate Management">Executive/Corporate Management</option>
                      <option value="Engineering/Technical Management">Engineering/Technical Management</option>
                      <option value="Engineer/Technician">Engineer/Technician</option>
                      <option value="Producer/Director">Producer/Director</option>
                      <option value="Video/Film/Sound Editor">Video/Film/Sound Editor</option>
                      <option value="Artist/Designer">Artist/Designer</option>
                      <option value="Writer/Composer">Writer/Composer</option>
                      <option value="Programming/Content Development">Programming/Content Development</option>
                      <option value="Business Development">Business Development</option>
                      <option value="Sales & Marketing">Sales &amp; Marketing</option>
                      <option value="Finance/Investment">Finance/Investment</option>
                      <option value="Corporate Communications/PR">Corporate Communications/PR</option>
                      <option value="IT/IS/Corporate MIS">IT/IS/Corporate MIS</option>
                      <option value="Educator/Trainer">Educator/Trainer</option>
                      <option value="Student">Student</option>
                      <option value="Other (FIB)">Other (FIB)</option>
                  </select>
              </span></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr bgcolor="#f2f2f2">
              <td colspan="2"><input name="chrContact" type="checkbox" id="chrContact" value="Yes" checked>
			  Stay in touch! Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products.</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><input name="Submit" type="submit" onClick="YY_checkform('form1','chrFirst','#q','0','Please enter your First Name.','chrLast','#q','0','Please enter your Last Name.','chrCompany','#q','0','Please enter your Company Name.','chrTitle','#q','0','Please enter your Title.','chrAddress1','#q','0','Please enter your Address \(Line 1 Required\).','chrCity','#q','0','Please enter your Town/City.','chrPostalCode','#q','0','Please enter your Postal/Zip Code.','chrPhone','#q','0','Please enter your Phone Number.','chrEmail','#q','0','Please enter your Email Address.','chrCountry','#q','1','Please choose your Country from the list.','Q1','#q','1','Please answer Question 1.','Q2','#q','1','Please answer Question 2.','Q3','#q','1','Please answer Question 3.');return document.MM_returnValue" value="Submit">
                <input name="idType" type="hidden" id="idType" value="1"></td>
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

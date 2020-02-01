<?php
	$BF = "";
	include('includes/top.php');
?>
<!-- This is the main body of the page.-->
<div class="main">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="3"><img src="images/nab2007se.gif" width="390" height="40" /></td>
  </tr>
  <tr>
    <td width="7" height="7"><img src="images/corner_top_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="images/line_top.gif"><img src="images/line_top.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="images/corner_top_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" background="images/line_left.gif"><img src="images/line_left.gif" width="7" height="7" /></td>
    <td width="786" bgcolor="#3F3F3F"><form id="form1" name="form1" method="post" action="thankyou.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2" class="title">Media Registration </td>
          </tr>
        <tr>
          <td colspan="2"><div id='errors'></div></td>
          </tr>
		<tr>
          <td height="45" colspan="2" class="disclaimer">Please register for the event using this website. For additional media related questions, please contact Christine Wilhelmy at cwilhelmy@apple.com or on mobile at 1-408-621-3120</td>
          </tr>
		<tr>
          <td width="50%"><span class="textboxname">First Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrFirst" type="text" class="formfield" id="chrFirst" size="35" /></td>
          <td width="50%"><span class="textboxname">Last   Name</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrLast" type="text" class="formfield" id="chrLast" size="35" /></td>
        </tr>
        <tr>
          <td width="50%"><span class="textboxname">Company Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrCompany" type="text" class="formfield" id="chrCompany" size="35" /></td>
          <td width="50%"><span class="textboxname">Country</span> <span class="textboxrequired">(Required)</span><br />
            <select name="chrCountry" size="1" class="formfield" id="chrCountry">
              <option value="" selected>Select Country</option>
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
            </select></td>
        </tr>
        <tr>
          <td><span class="textboxname">Phone Number </span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrPhone" type="text" class="formfield" id="chrPhone" size="35" /></td>
          <td><span class="textboxname">Email Address </span> <span class="textboxrequired">(Confirmation will be sent to this address)</span><br />
            <input name="chrEmail" type="text" class="formfield" id="chrEmail" size="35" /></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="checkbox" name="checkbox" value="Yes" />
            <span class="disclaimer">Stay in touch! Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products.</span></td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="button" name="Submit" value="Register for this Special Event" onclick='error_check();' />
		  <input type="hidden" name="idType" value="3" /></td>
          </tr>
        <tr>
          <td colspan="2" class="disclaimer">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2" class="disclaimer"><a href="http://www.apple.com/legal/privacy/">Apple Privacy Policy</a> <br />
You're in control. You always have access to your personal information and contact preferences, so you can change them at any time. To learn how Apple safeguards your personal information, please review the Apple Customer Privacy Policy.  If you would rather not receive this information, please uncheck the box.</td>
        </tr>
      </table>
    </form>
    </td>
    <td width="7" background="images/line_right.gif"><img src="images/line_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" height="7"><img src="images/corner_bottom_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="images/line_bottom.gif"><img src="images/line_bottom.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="images/corner_bottom_right.gif" width="7" height="7" /></td>
  </tr>
</table>
</div>
<!-- This is the bottom of the body -->
<?php
	include('includes/bottom.php');
?>
<script language="JavaScript" src="includes/forms.js"></script>
<script language="javascript">
	function error_check() {
		if(total != 0) { reset_errors(); }  

		var total=0;

		total += ErrorCheck('chrFirst', "You must enter a First Name.");
		total += ErrorCheck('chrLast', "You must enter a Last Name.");
		total += ErrorCheck('chrCompany', "You must enter an Company Name.");
		total += ErrorCheck('chrPhone', "You must enter a Phone Number.");
		total += ErrorCheck('chrCountry', "You must choose a Country.");
		total += ErrorCheck('chrEmail', "You must enter an Email Address.","email");

		if(total == 0) { document.getElementById('form1').submit(); }
	}
</script>
</body>
</html>

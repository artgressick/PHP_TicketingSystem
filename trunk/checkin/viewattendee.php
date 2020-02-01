<?php
	$BF = "../";
	include($BF.'_lib.php');
	
	//Make the original query
	$query = "SELECT idType, chrFirst, chrLast, chrCompany, chrTitle, chrAddress1, chrAddress2, chrAddress3, chrCity, chrState, chrPostalCode,
	chrPhone, chrEmail, chrWWDR, chrDivisionDepartment, chrContact, idStatus, chrCountry, Q1, Q2, Q3, chrSpecial
	FROM attendees WHERE ID = '".$_REQUEST['id']."'";
	
	$attendee = fetch_database_query($query,"Getting Attendee");

	include('includes/meta.php');
	include('includes/top.php');
?>
<!-- This is the main body of the page.-->
<div class="main">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="3"><img src="<?=$BF?>images/nab2007se.gif" width="390" height="40" /></td>
  </tr>
    <tr>
    <td width="7" height="7"><img src="<?=$BF?>images/corner_top_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="<?=$BF?>images/line_top.gif"><img src="<?=$BF?>images/line_top.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="<?=$BF?>images/corner_top_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" background="<?=$BF?>images/line_left.gif"><img src="<?=$BF?>images/line_left.gif" width="7" height="7" /></td>
    <td bgcolor="#3F3F3F">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td id=cont><form name="form1" method="post" action="updateattendee.php">
            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="50%" class="title">Edit Attendee</td>
                <td width="50%" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" style="color:#CCCCCC;">All fields are being displayed for your convience please check the Attendee Group. You will see tags near each field for which group it relates to. </td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td colspan="2" style="text-align:center;"><input name="Submit" type="submit" value="Check In Attendee">
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>">
                        <input name="chrSpecial" type="hidden" id="chrSpecial" value="<?=$attendee['chrSpecial']?>"></td>
                  </tr>
				  <tr>
                    <td width="50%" style="color:#CCCCCC;">Attendee Group<br>
                      <strong>
                      <select name="idType" size="1" id="idType">
                        <option value="1" <?php if ($attendee['idType'] == 1) { echo "selected"; }?>>General</option>
                        <option value="2" <?php if ($attendee['idType'] == 2) { echo "selected"; }?>>VIP</option>
                        <option value="3" <?php if ($attendee['idType'] == 3) { echo "selected"; }?>>Press</option>
                        <option value="4" <?php if ($attendee['idType'] == 4) { echo "selected"; }?>>Apple</option>
                      </select>
                      </strong></td>
                    <td width="50%" style="color:#CCCCCC;">Status<br>
                      <strong>
                      <select name="idStatus" size="1" id="idStatus">
                        <option value="1" <?php if ($attendee['idStatus'] == 1) { echo "selected"; }?>>Active</option>
                        <option value="2" <?php if ($attendee['idStatus'] == 2) { echo "selected"; }?>>Cancelled</option>
						<option value="3" <?php if ($attendee['idStatus'] == 3) { echo "selected"; }?>>Wait List</option>
                      </select>
                      <input name="idOrgStatus" type="hidden" id="idOrgStatus" value="<?=$attendee['idStatus']?>"></strong> </td>
                  </tr>
				  <tr>
                    <td width="50%" style="color:#CCCCCC;">First Name <span class="sosumi">(All)</span><br>
                        <input name="chrFirst" type="text" id="chrFirst" size="30" maxlength="30" value="<?=$attendee['chrFirst']?>">
                    </td>
                    <td width="50%" style="color:#CCCCCC;">Last Name <span class="sosumi">(All) </span><br>
                        <input name="chrLast" type="text" id="chrLast" size="30" maxlength="30" value="<?=$attendee['chrLast']?>">
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#CCCCCC;">Company Name <span class="sosumi">(All) </span><br>
                        <input name="chrCompany" type="text" id="chrCompany" size="30" maxlength="50" value="<?=$attendee['chrCompany']?>">
                    </td>
                    <td style="color:#CCCCCC;">Title <span class="sosumi">(General &amp; VIP)</span> <br>
                        <input name="chrTitle" type="text" id="chrTitle" size="30" maxlength="50" value="<?=$attendee['chrTitle']?>">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;"><p>Address <span class="sosumi">(General)</span> <br>
                            <input name="chrAddress1" type="text" id="chrAddress1" size="45" maxlength="50" value="<?=$attendee['chrAddress1']?>">
                            <br>
                            <input name="chrAddress2" type="text" id="chrAddress2" size="45" maxlength="50" value="<?=$attendee['chrAddress2']?>">
                            <br>
                            <input name="chrAddress3" type="text" id="chrAddress3" size="45" maxlength="50" value="<?=$attendee['chrAddress3']?>">
                    </p></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;">Town/City <span class="sosumi">(General)</span> <br>
                        <input name="chrCity" type="text" id="chrCity" size="40" maxlength="50" value="<?=$attendee['chrCity']?>">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;">State/Province<span class="sosumi"> (General)</span> <br>
                        <input name="chrState" type="text" id="chrState" size="4" maxlength="2" value="<?=$attendee['chrState']?>">
      (US/Canada only) </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;">Postal Code <span class="sosumi">(General)</span><br>
                        <input name="chrPostalCode" type="text" id="chrPostalCode" size="30" maxlength="20" value="<?=$attendee['chrPostalCode']?>">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;">Country <span class="sosumi">(General)</span> <br>
                      <input name="chrCountry" type="text" id="chrCountry" size="35" maxlength="50" value="<?=$attendee['chrCountry']?>">
</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;">Phone Number <span class="sosumi">(General)</span><br>
                        <input name="chrPhone" type="text" id="chrPhone" size="30" maxlength="25" value="<?=$attendee['chrPhone']?>"> (ex. 408-555-1212 or 44-182-726-0715) </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="color:#CCCCCC;"><p>Email Address<span class="sosumi"> (All) </span><br>
                            <input name="chrEmail" type="text" id="chrEmail" size="45" maxlength="40" value="<?=$attendee['chrEmail']?>">
                    </p></td>
                  </tr>
                  <tr bgcolor="#f2f2f2">
                    <td colspan="2"><input name="chrContact" type="checkbox" id="chrContact" value="Yes" <?php if ($attendee['chrContact'] == "Yes") { echo "checked"; }?>>
      Stay in touch! Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products.</td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="Submit" type="submit" value="Check In Attendee"></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table>
    </td>
    <td width="7" background="<?=$BF?>images/line_right.gif"><img src="<?=$BF?>images/line_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" height="7"><img src="<?=$BF?>images/corner_bottom_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="<?=$BF?>images/line_bottom.gif"><img src="<?=$BF?>images/line_bottom.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="<?=$BF?>images/corner_bottom_right.gif" width="7" height="7" /></td>
  </tr>
</table>
</div>
<!-- This is the bottom of the body -->
<?php
	include('includes/bottom.php');
?>
</body>
</html>
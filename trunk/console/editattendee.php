<?php
	$BF = "../";
	include('../_lib.php');
	
	//Check for idUser
	if ($_SESSION['idUser'] == '') {
		header("Location: login.php");
		die();
	}
	
	//Check for a post
	if(isset($_POST['chrFirst'])) { // When doing isset, use a required field.  Faster than the php count funtion.
	
		$q = "UPDATE attendees SET 
				idStatus = '". $_POST['idStatus'] ."',
				idType = '". $_POST['idType'] ."',
				chrFirst = '". $_POST['chrFirst'] ."',
				chrLast = '". $_POST['chrLast'] ."',
				chrCompany = '". $_POST['chrCompany'] ."',
				chrTitle = '". $_POST['chrTitle'] ."',
				chrAddress1 = '". $_POST['chrAddress1'] ."',
				chrAddress2 = '". $_POST['chrAddress2'] ."',
				chrAddress3 = '". $_POST['chrAddress3'] ."',
				chrCity = '". $_POST['chrCity'] ."',
				chrState = '". $_POST['chrState'] ."',
				chrPostalCode = '". $_POST['chrPostalCode'] ."',
				chrCountry = '". $_POST['chrCountry'] ."',
				chrPhone = '". $_POST['chrPhone'] ."',
				chrEmail = '". $_POST['chrEmail'] ."',
				Q1 = '". $_POST['Q1'] ."',
				Q2 = '". $_POST['Q2'] ."',
				Q3 = '". $_POST['Q3'] ."',
				Q4a='". $_POST['Q4a'] ."',
				Q4b='". $_POST['Q4b'] ."',
				Q4c='". $_POST['Q4c'] ."',
				Q4d='". $_POST['Q4d'] ."',
				Q4e='". $_POST['Q4e'] ."',
				Q4f='". $_POST['Q4f'] ."'
			WHERE ID = '". $_REQUEST['ID'] ."'		
		";
		
		database_query($q,"update attendee");
		
		//This is there the code goes to send a possible email to the people.
		//***********************************************************************************************************************
		//Marc Liyanage Encryption String
		$PDF_FILENAME = "NAB-2007-Ticket.pdf";
	
		//echo make_encrypted_url("document=nab-2007-ticket.svg&fullname=Marc%20Liyanage&company=entropy.ch&barcode_value=123456&barcode_text=11223344&type=Guest%20Ticket");
	
		function make_encrypted_url($parameters) {
			global $PDF_FILENAME;
			return "http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/$PDF_FILENAME?data=" . bin2hex(encrypt_parameter_string($parameters));
		}
	
		function encrypt_parameter_string($string) {
			$cipher     = "rijndael-128";
			$mode       = "cbc";
			$plain_text = $string;
			$secret_key = "Rf4RQ5zD2LqjbmVQ";
			$iv         = "6Uhx6YhujT4FhdJS";
			
			$td = mcrypt_module_open($cipher, "", $mode, $iv);
			mcrypt_generic_init($td, $secret_key, $iv);
			$cyper_text = mcrypt_generic($td, $plain_text);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			return $cyper_text;
		}
			
		//***********************************************************************************************************************	
		//Set a list of Variable that we are going to send out as an email
			//$chrSpecial = already declared above
		//--Build the Values to make the PDF
			$chrFirst = stripslashes($_POST['chrFirst']);
			$chrLast = stripslashes($_POST['chrLast']);
			$chrEmail = $_POST['chrEmail'];
			$chrCompany = stripslashes($_POST['chrCompany']);
			$chrSpecial = $_POST['chrSpecial'];
		
			$BarNumber = sprintf("%09d", $ID)."000"; //Make a 9 digit
			$BarString = $chrLast.",".$chrFirst;
			$Postfullname = $chrFirst." ".$chrLast;
			$fullname = $chrFirst."+".$chrLast;
	
	// Send an email to the people who were on Wailist into confirmed.
		if (($_POST['idOrgStatus'] == 2) && ($_POST['idStatus'] == 1)) { //Then
			$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
			//----
			$Subject = "NAB 2007 Apple Special Event Registration Confirmation";
			//----
			$Message = "Dear $chrFirst $chrLast,\n\n";
			$Message .= "Your registration status for the Apple Special Presentation at NAB has been changed from 'waitlist' to 'confirmed'.\n\n";
			$Message .= "This email confirms your registration for the following event:\n\n";
			$Message .= "Apple Special Presentation\n\n";
			$Message .= "April 15th, 2007 beginning at 11:00 a.m. PDT\n";
			$Message .= "Reception to follow.\n\n";
			$Message .= "A confirmation ticket has been created and may be retrieved from the link below.  To expedite check-in, please bring this ticket with you to the event.\n\n";
			$Message .= "Confirmation Ticket: (You may have to copy and paste link in browser)\n";
			$Message .= make_encrypted_url("document=nab-2007-ticket.svg&fullname=$fullname&company=$chrCompany&barcode_value=$BarNumber&barcode_string=$BarString&type=Guest Ticket");
			$Message .= "\n\nRegistration for this event will open at 9:30 a.m. We do expect the room to reach full capacity. Seating is on a first come first serve basis, and while we will try our best to accommodate, we do not guarantee admission if you arrive late for the presentation.\n\n";
			$Message .= "Location\n";
			$Message .= "Venetian Ballrooom\n";
			$Message .= "Venetian Hotel & Casion\n";
			$Message .= "Las Vegas, Nevada\n\n";			
			$Message .= "If you are unable to attend this event, please cancel your registration online: http://nab2007.itechit.com/cancel.php?idAttendee=$chrSpecial\n\n\n";
			$Message .= "We look forward to seeing you at NAB 2007!\n\n";
			$Message .= "Apple Events\n\n\n";
		
		//Send this email for the waitlist to confirmed people
		mail($chrEmail, $Subject, $Message, $Headers);
		
		} elseif ($_POST['chkEmail'] == "1") { //RESEND EMAIL TO USERS
			if ($_POST['idType'] == 2) { //VIP email
				$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
				//----
				$Subject = "NAB 2007 Apple Special Event Registration Confirmation";
				//----
				$Message = "Dear $chrFirst $chrLast,\n\n";
				$Message .= "Thank you for registering to attend the following event:\n\n";
				$Message .= "Apple Special Presentation\n\n";
				$Message .= "April 15th, 2007 beginning at 11:00 a.m. PDT\n";
				$Message .= "Reception to follow.\n\n";
				$Message .= "A confirmation ticket has been created and may be retrieved from the link below.  To expedite check-in, please bring this ticket with you to the event.\n\n";
				$Message .= "Confirmation Ticket: (You may have to copy and paste link in browser)\n";
				$Message .= make_encrypted_url("document=nab-2007-ticket.svg&fullname=$fullname&company=$chrCompany&barcode_value=$BarNumber&barcode_string=$BarString&type=VIP Ticket");
				$Message .= "\n\nSpecial VIP seating has been arranged for your convenience.  Please stop by the VIP Check-In Desk to pickup your badge.  The VIP Check-In Desk will open at 9:30 a.m.\n\n";
				$Message .= "Location:\n";
				$Message .= "Venetian Ballroom\n";
				$Message .= "Venetian Hotel & Casino\n";
				$Message .= "Las Vegas, Nevada\n\n";
				$Message .= "If you are unable to attend this event, please cancel your registration online: http://nab2007.itechit.com/cancel.php?idAttendee=$chrSpecial\n\n\n";
				$Message .= "We look forward to seeing you at NAB 2007!\n\n";
				$Message .= "Apple Events\n\n\n";
	//-----------------------------------------------
			} else if ($_POST['idType'] == 3) { //Media email
				$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
				//----
				$Subject = "NAB 2007 Apple Special Event Registration Confirmation";
				//----
				$Message = "Dear $chrFirst $chrLast,\n\n";
				$Message .= "Thank you for registering to attend the following event:\n\n";
				$Message .= "Apple Special Presentation\n\n";
				$Message .= "April 15th, 2007 beginning at 11:00 a.m. PDT\n";
				$Message .= "Reception to follow.\n\n";
				$Message .= "A confirmation ticket has been created and may be retrieved from the link below.  To expedite check-in, please bring this ticket with you to the event.\n\n";
				$Message .= "Confirmation Ticket: (You may have to copy and paste link in browser)\n";
				$Message .= make_encrypted_url("document=nab-2007-ticket.svg&fullname=$fullname&company=$chrCompany&barcode_value=$BarNumber&barcode_string=$BarString&type=Media Ticket");
				$Message .= "\n\nSpecial media seating has been arranged for your convenience.  Please stop by the media Check-In Desk to pickup your badge.  The media Check-In Desk will open at 9:30 a.m.\n\n";
				$Message .= "For additional media related questions, please contact Christine Wilhelmy at cwilhelmy@apple.com or on mobile at 1-408-621-3120.\n\n";
				$Message .= "Location\n";
				$Message .= "Venetian Ballroom\n";
				$Message .= "Venetian Hotel & Casino\n";
				$Message .= "Las Vegas, Nevada\n\n";	
				$Message .= "If you are unable to attend this event, please cancel your registration online: http://nab2007.itechit.com/cancel.php?idAttendee=$chrSpecial\n\n\n";
				$Message .= "We look forward to seeing you at NAB 2007!\n\n";
				$Message .= "Apple Events\n\n\n";
	//-------------------------------------------------
			} else { //This is all others (General)
				$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
				//----
				$Subject = "NAB 2007 Apple Special Event Registration Confirmation";
				//----
				$Message = "Dear $chrFirst $chrLast,\n\n";
				$Message .= "Thank you for registering to attend the following event:\n\n";
				$Message .= "Apple Special Presentation\n\n";
				$Message .= "April 15th, 2007 beginning at 11:00 a.m. PDT\n";
				$Message .= "Reception to follow.\n\n";
				$Message .= "A confirmation ticket has been created and may be retrieved from the link below.  To expedite check-in, please bring this ticket with you to the event.\n\n";
				$Message .= "Confirmation Ticket: (You may have to copy and paste link in browser)\n";
				$Message .= make_encrypted_url("document=nab-2007-ticket.svg&fullname=$fullname&company=$chrCompany&barcode_value=$BarNumber&barcode_string=$BarString&type=Guest Ticket");
				$Message .= "\n\nRegistration for this event will open at 9:30 a.m. We do expect the room to reach full capacity. Seating is on a first come first serve basis, and while we will try our best to accommodate, we do not guarantee admission if you arrive late for the presentation.\n\n";
				$Message .= "Location\n";
				$Message .= "Venetian Ballrooom\n";
				$Message .= "Venetian Hotel & Casion\n";
				$Message .= "Las Vegas, Nevada\n\n";			
				$Message .= "If you are unable to attend this event, please cancel your registration online: http://nab2007.itechit.com/cancel.php?idAttendee=$chrSpecial\n\n\n";
				$Message .= "We look forward to seeing you at NAB 2007!\n\n";
				$Message .= "Apple Events\n\n\n";
			} //This is the end of the confirmed emails
			
		mail($chrEmail, $Subject, $Message, $Headers);
		}
		
		header("Location: search.php");
		die();
		
	}	
	
	
	//Search for attendees
	$q = "SELECT * FROM attendees where ID = '" . $_REQUEST['id'] . "'";
	
	$record = mysqli_fetch_assoc(database_query($q,"Get the attendee information"));	
	
	include('includes/meta.php');
	include('includes/top.php');
?>
<!-- This is the main body of the page.-->
<div class="main">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="3"><img src="../images/nab2007se.gif" width="390" height="40" /></td>
  </tr>
  <tr>
    <td width="7" height="7"><img src="../images/corner_top_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="../images/line_top.gif"><img src="../images/line_top.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="../images/corner_top_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" background="../images/line_left.gif"><img src="../images/line_left.gif" width="7" height="7" /></td>
    <td width="786" bgcolor="#3F3F3F"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2" class="title">Edit Attendee</td>
        </tr>
        <tr>
          <td colspan="2"><div id='errors'></div></td>
        </tr>
		<tr>
          <td colspan="2">
		  	<div style="background-color:#CCCCCC; margin-bottom:5px; margin-top:2px; font-size:11px;"><input type="checkbox" name="chkEmail" value="1" /> 
			Resend email to individual when updated. This is dependant on the prior status and the new status.</div>
		  </td>
        </tr>
		<tr>
          <td width="50%"><span class="textboxname">Attendee Type</span> <span class="textboxrequired">(Required)</span> <br />
              <select name="idType" size="1" id="idType">
                  <option<?=($record['idType'] == 1 ? ' selected' : '')?> value="1">General</option>
                  <option<?=($record['idType'] == 2 ? ' selected' : '')?> value="2">VIP</option>
                  <option<?=($record['idType'] == 3 ? ' selected' : '')?> value="3">Press/Media</option>
				  <option<?=($record['idType'] == 4 ? ' selected' : '')?> value="4">Apple</option>
              </select>
              </td>
          <td width="50%"><span class="textboxname">Status</span> <span class="textboxrequired">(Required)</span><br />
              <select name="idStatus" size="1" id="idStatus">
                  <option<?=($record['idStatus'] == 1 ? ' selected' : '')?> value="1">Confirmed</option>
                  <option<?=($record['idStatus'] == 2 ? ' selected' : '')?> value="2">Waitlist</option>
                  <option<?=($record['idStatus'] == 3 ? ' selected' : '')?> value="3">Cancelled</option>
              </select>
              </td>
		</tr>
        <tr>
          <td width="50%"><span class="textboxname">First Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrFirst" type="text" class="formfield" id="chrFirst" size="35" value="<?=$record['chrFirst']?>" /></td>
          <td width="50%"><span class="textboxname">Last   Name</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrLast" type="text" class="formfield" id="chrLast" size="35" value="<?=$record['chrLast']?>" /></td>
        </tr>
        <tr>
          <td width="50%"><span class="textboxname">Company Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrCompany" type="text" class="formfield" id="chrCompany" size="35" value="<?=$record['chrCompany']?>" /></td>
          <td width="50%"><span class="textboxname">Title</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrTitle" type="text" class="formfield" id="chrTitle" size="35" value="<?=$record['chrTitle']?>" /></td>
        </tr>
        <tr>
          <td colspan="2"><span class="textboxname">Address</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrAddress1" type="text" class="formfield" id="chrAddress1" size="45" value="<?=$record['chrAddress1']?>" />
            <br />
            <input name="chrAddress2" type="text" class="formfield" id="chrAddress2" size="45" value="<?=$record['chrAddress2']?>" />
            <br />
            <input name="chrAddress3" type="text" class="formfield" id="chrAddress3" size="45" value="<?=$record['chrAddress3']?>" /></td>
          </tr>
        <tr>
          <td><span class="textboxname">Town/City</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrCity" type="text" class="formfield" id="chrCity" size="35" value="<?=$record['chrCity']?>" /></td>
          <td><span class="textboxname">State/Province</span> <span class="textboxrequired">(USA/Canada Only)</span><br />
            <input name="chrState" type="text" class="formfield" id="chrState" size="25" value="<?=$record['chrState']?>" /></td>
        </tr>
        <tr>
          <td><span class="textboxname">Postal Code with Country Code </span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrPostalCode" type="text" class="formfield" id="chrPostalCode" size="35" value="<?=$record['chrPostalCode']?>" /></td>
          <td><span class="textboxname">Country </span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrCountry" type="text" class="formfield" id="chrCountry" size="35" value="<?=$record['chrCountry']?>" /></td>
        </tr>
        <tr>
          <td><span class="textboxname">Phone Number </span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrPhone" type="text" class="formfield" id="chrPhone" size="35" value="<?=$record['chrPhone']?>" /></td>
          <td><span class="textboxname">Email Address </span> <span class="textboxrequired">(Confirmation will be sent to this address)</span><br />
            <input name="chrEmail" type="text" class="formfield" id="chrEmail" size="35" value="<?=$record['chrEmail']?>" /></td>
        </tr>
        <tr>
          <td colspan="2" height="20"><hr align="center" width="99%" size="1" noshade="noshade" /></td>
          </tr>
        <tr>
          <td width="50%"><span class="textboxname">My organization type is:</span><br />
            <select name="Q1" size="1" class="formfield" id="Q1">
              <option<?=($record['Q1'] == '' ? ' selected' : '')?> value="" selected>Please choose</option>
			  <option<?=($record['Q1'] == 'Business/Commercial' ? ' selected' : '')?> value="Business/Commercial">Business/Commercial</option>
			  <option<?=($record['Q1'] == 'Education (High Ed)' ? ' selected' : '')?> value="Education (High Ed)">Education (High Ed)</option>
			  <option<?=($record['Q1'] == 'Education (K-12)' ? ' selected' : '')?> value="Education (K-12)">Education (K-12)</option>
			  <option<?=($record['Q1'] == 'Student' ? ' selected' : '')?> value="Student">Student</option>
			  <option<?=($record['Q1'] == 'Government' ? ' selected' : '')?> value="Government">Government</option>
			  <option<?=($record['Q1'] == 'Individual' ? ' selected' : '')?> value="Individual">Individual</option>
			  <option<?=($record['Q1'] == 'Reseller' ? ' selected' : '')?> value="Reseller">Reseller</option>
            </select></td>
          <td width="50%"><span class="textboxname">My organization size is: </span><br />
            <select name="Q2" size="1" class="formfield" id="Q2">
              <option<?=($record['Q2'] == '' ? ' selected' : '')?> value="" selected>Please choose</option>
			  <option<?=($record['Q2'] == '1 to 10' ? ' selected' : '')?> value="1 to 10">1 to 10</option>
			  <option<?=($record['Q2'] == '10 to 49' ? ' selected' : '')?> value="10 to 49">10 to 49</option>
			  <option<?=($record['Q2'] == '50 to 99' ? ' selected' : '')?> value="50 to 99">50 to 99</option>
			  <option<?=($record['Q2'] == '100 to 499' ? ' selected' : '')?> value="100 to 499">100 to 499</option>
			  <option<?=($record['Q2'] == '500 to 999' ? ' selected' : '')?> value="500 to 999">500 to 999</option>
			  <option<?=($record['Q2'] == '100 to 500' ? ' selected' : '')?> value="100 to 500">100 to 500</option>
			  <option<?=($record['Q2'] == '1000+' ? ' selected' : '')?> value="1000+">1000+</option>
            </select></td>
        </tr>
		<tr>
          <td colspan="2" style="padding-top:15px;"><table width="70%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="3"><span class="textboxname">I work with the following formats:</span></td>
              </tr>
            <tr>
              <td width="33%"><input name="Q4a" type="checkbox" id="Q4a" value="HD"<?=($record['Q4a'] == 'HD' ? ' checked' : '')?> />
                <span class="textboxrequired">HD</span></td>
              <td width="34%"><input name="Q4c" type="checkbox" id="Q4c" value="HDV"<?=($record['Q4c'] == 'HDV' ? ' checked' : '')?> />
                <span class="textboxrequired">HDV</span></td>
              <td width="33%"><input name="Q4e" type="checkbox" id="Q4e" value="Film or Other"<?=($record['Q4e'] == 'Film or Other' ? ' checked' : '')?> />
                <span class="textboxrequired">Film or Other </span></td>
            </tr>
            <tr>
              <td><input name="Q4b" type="checkbox" id="Q4b" value="SD"<?=($record['Q4b'] == 'SD' ? ' checked' : '')?> />
                <span class="textboxrequired">SD</span></td>
              <td><input name="Q4d" type="checkbox" id="Q4d" value="DV-miniDV"<?=($record['Q4d'] == 'DV-miniDV' ? ' checked' : '')?> /> 
                <span class="textboxrequired">DV/mini DV</span></td>
              <td><input name="Q4f" type="checkbox" id="Q4f" value="Not applicable"<?=($record['Q4f'] == 'Not applicable' ? ' checked' : '')?> /> 
                <span class="textboxrequired">Not applicable </span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td width="100%" colspan="2" style="padding-top:15px;"><span class="textboxname">From whom do you primarily purchase Apple products for Video? </span><br />
            <select name="Q3" size="1" class="formfield" id="Q3">
              <option<?=($record['Q3'] == '' ? ' selected' : '')?> value="" selected>Please choose</option>
			  <option<?=($record['Q3'] == 'Apple Reseller' ? ' selected' : '')?> value="Apple Reseller">From an Apple reseller (Promax, B&H, Tekserve, MacMall, etc.)</option>
			  <option<?=($record['Q3'] == 'Apple Retail' ? ' selected' : '')?> value="Apple Retail">Apple Online Store or Apple Retail Store</option>
			  <option<?=($record['Q3'] == 'Apple Direct' ? ' selected' : '')?> value="Apple Direct">Apple Direct (I have an Apple Account Rep)</option>
			  <option<?=($record['Q3'] == 'None' ? ' selected' : '')?> value="None">None of the above</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="button" name="Submit" value="Update Attendee Information" onclick='error_check();' />
		  <input type="hidden" name="ID" value="<?=$_REQUEST['id']?>" />
		  <input type="hidden" name="idOrgStatus" value="<?=$record['idStatus']?>" />
		  <input type="hidden" name="chrSpecial" value="<?=$record['chrSpecial']?>" /></td>
        </tr>
      </table>
    </form>
    </td>
    <td width="7" background="../images/line_right.gif"><img src="../images/line_right.gif" width="7" height="7" /></td>
  </tr>
  <tr>
    <td width="7" height="7"><img src="../images/corner_bottom_left.gif" width="7" height="7" /></td>
    <td width="786" height="7" background="../images/line_bottom.gif"><img src="../images/line_bottom.gif" width="7" height="7" /></td>
    <td width="7" height="7"><img src="../images/corner_bottom_right.gif" width="7" height="7" /></td>
  </tr>
</table>
</div>
<!-- This is the bottom of the body -->
<?php
	include('includes/bottom.php');
?>
<script language="JavaScript" src="../includes/forms.js"></script>
<script language="javascript">
	function error_check() {
		if(total != 0) { reset_errors(); }  

		var total=0;

		total += ErrorCheck('chrFirst', "You must enter a First Name.");
		total += ErrorCheck('chrLast', "You must enter a Last Name.");
		total += ErrorCheck('chrEmail', "You must enter an Email Address.","email");

		if(total == 0) { document.getElementById('form1').submit(); }
	}
</script>
</body>
</html>

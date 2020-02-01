<?php
	$BF = "";
	require('_lib.php');
	
	//idEvent; 3 = NAB 2007
	//idType; 1 is general, 2 is VIP, 3 is WWDR/Press, 4 is Apple Corp (Not used)

	if(isset($_POST['chrFirst'])) { // When doing isset, use a required field.  Faster than the php count funtion.
	
	//We are getting a ton of duplicates and need to find a way to check for email addresses that have already been entered
		$q = "SELECT ID FROM attendees WHERE idEvent=3 AND chrEmail = '". $_POST['chrEmail'] ."'";
		
		$duplicate = database_query($q,"check duplicates");
		
		if(mysqli_num_rows($duplicate) > 0) {
			header('Location: duplicate.php');
			die();	
		
		} //If we pass this then no duplicates where found.
	
	
	//***********************************************************************************************************************
	//Check to see how man people have signed up for the events already
		$q = "SELECT COUNT(ID) as intTotal FROM attendees WHERE idEvent=3 AND idStatus=1"; //intTotal is the total number of people confirmed
		
		$intTotal = mysqli_fetch_assoc(database_query($q,"count attendees"));
		
	//Choose the type of status for the person
		if (($intTotal['intTotal'] <= 3250) or ($_POST['idType'] == 2) or ($_POST['idType'] == 3)) { //VIP & Press don't get on a wait list but everyone else does after the limit
			$idStatus = 1; //Confirmed
		} else {
			$idStatus = 2; //Waitlist
		}
		
	//Insert the record with the proper status, show and type
		$q = "INSERT INTO attendees SET
			idEvent='3',
			idStatus='". $idStatus ."',
			idType='" . $_POST['idType'] ."',			
			chrFirst='". $_POST['chrFirst'] ."',
			chrLast='". $_POST['chrLast'] ."',
			chrCompany='". $_POST['chrCompany'] ."',
			chrTitle='". $_POST['chrTitle'] ."',
			chrAddress1='". $_POST['chrAddress1'] ."',
			chrAddress2='". $_POST['chrAddress2'] ."',
			chrAddress3='". $_POST['chrAddress3'] ."',
			chrCity='". $_POST['chrCity'] ."',
			chrState='". $_POST['chrState'] ."',
			chrPostalCode='". $_POST['chrPostalCode'] ."',
			chrCountry='". $_POST['chrCountry'] ."',
			chrPhone='". $_POST['chrPhone'] ."',
			chrEmail='". $_POST['chrEmail'] ."',
			chrWWDR='". $_POST['chrWWDR'] ."',
			chrDivisionDepartment='". $_POST['chrDivisionDepartment'] ."',
			chrContact='". $_POST['chrContact'] ."',
			Q1='". $_POST['Q1'] ."',
			Q2='". $_POST['Q2'] ."',
			Q3='". $_POST['Q3'] ."',
			Q4a='". $_POST['Q4a'] ."',
			Q4b='". $_POST['Q4b'] ."',
			Q4c='". $_POST['Q4c'] ."',
			Q4d='". $_POST['Q4d'] ."',
			Q4e='". $_POST['Q4e'] ."',
			Q4f='". $_POST['Q4f'] ."'
		";
		database_query($q,"Insert into attendees");
		
	//Now get the ID from the person whom we entered
		global $mysqli_connection;
		$ID = mysqli_insert_id($mysqli_connection);
		
	//Encode the chrSpecial Tag and update the Attendee
		$chrSpecial = md5($ID);
	
		$q = "UPDATE attendees SET chrSpecial = '".$chrSpecial."' WHERE ID = '".$ID."'";
		database_query($q,"update special code");
		
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
	
		$BarNumber = sprintf("%09d", $ID)."000"; //Make a 9 digit
		$BarString = $chrLast.",".$chrFirst;
		$Postfullname = $chrFirst." ".$chrLast;
		$fullname = $chrFirst."+".$chrLast;
		
	// Send an email to the attendee but we need to check whic type they are before we send the email.
	if ($idStatus == 1) {
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
			// Original Message
			//$Message .= "<http://apple.itechit.com:9006/pdfrenderservice/get-pdf/NAB2005.pdf?fullname=$fullname&barcode_value=$BarNumber&barcode_string=$BarString&document=NAB-ticket-jk485.svg>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/Photokina-2006.pdf?document=photokina-2006-ticket-en.svg&barcode_value=$BarNumber&fullname=$fullname&type=VIP>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/NAB-2007-Ticket.pdf?document=nab-2007-ticket.svg&barcode_value=$BarNumber&fullname=$fullname&company=$chrCompany&type=VIP&barcode_string=$BarString>\n\n";
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
			// Original Message
			//$Message .= "<http://apple.itechit.com:9006/pdfrenderservice/get-pdf/NAB2005.pdf?fullname=$fullname&barcode_value=$BarNumber&barcode_string=$BarString&document=NAB-ticket-jk485.svg>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/Photokina-2006.pdf?document=photokina-2006-ticket-en.svg&barcode_value=$BarNumber&fullname=$fullname&type=Media>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/NAB-2007-Ticket.pdf?document=nab-2007-ticket.svg&barcode_value=$BarNumber&fullname=$fullname&company=$chrCompany&type=Media>\n\n";
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
			// Original Message
			//$Message .= "<http://apple.itechit.com:9006/pdfrenderservice/get-pdf/NAB2005.pdf?fullname=$fullname&barcode_value=$BarNumber&barcode_string=$BarString&document=NAB-ticket-jk485.svg>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/Photokina-2006.pdf?document=photokina-2006-ticket-en.svg&barcode_value=$BarNumber&fullname=$fullname&type=General>\n\n";
			//$Message .= "<http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/NAB-2007-Ticket.pdf?document=nab-2007-ticket.svg&barcode_value=$BarNumber&fullname=$fullname&company=$chrCompany&type=Guest%20Ticket>\n\n";
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
	} else { //This is the standby email
			$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
			//----
			$Subject = "Waitlist Confirmation - NAB 2007 Apple Special Event";
			//----
			$Message = "Dear $chrFirst $chrLast,\n\n";
			$Message .= "You have been added to the waiting list for the following event:\n\n";
			$Message .= "Apple Special Presentation\n";
			$Message .= "NAB 2007\n";
			$Message .= "April 15, 2007 beginning at 11:00 a.m. PDT\n\n\n";
			$Message .= "**   NOTE: THIS IS NOT A CONFIRMATION.\n\n";
			$Message .= "**   IF SEATING BECOMES AVAILABLE, YOUR REGISTRATION WILL BE CONFIRMED BY EMAIL.\n\n";
			$Message .= "**   SEATING IS FOR CONFIRMED REGISTRANTS ONLY.\n\n\n";
			$Message .= "Best Regards,\n\n";
			$Message .= "Apple Events\n\n\n";
	} //This is the end of all emails.
		mail($chrEmail, $Subject, $Message, $Headers);
	} //This is from the post	
	//***********************************************************************************************************************
	//Do the rest of the page
?>
<?php
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
    <td width="786" bgcolor="#3F3F3F"><form id="idForm" name="idForm" method="get" action="http://nab2007.itechit.com:9006/pdfrenderservice/get-pdf/<?=$PDF_FILENAME?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
	if ($idStatus == 1) {
?>
		<tr>
          <td width="100%" class="title">Registration Confirmation</td>
          </tr>
        <tr>
          <td><p class="disclaimer">You have been confirmed to attend the NAB 2007 Apple Special Presentation. &nbsp;A confirmation email has been sent to you.</p>
<?php
		//Media Disclaimer
		if ($_POST['idType'] == 3) {
?>
		  	<p class="disclaimer">Special Media seating has been arranged for your convenience.  Please stop by the media Check-In Desk to pickup your badge.  The media Check-In Desk will open at 9:30 a.m.</p>
<?php
		}
		//VIP Disclaimer
		if ($_POST['idType'] == 2) {
?>
			<p class="disclaimer">Special VIP seating has been arranged for your convenience.  Please stop by the VIP Check-In Desk to pickup your badge.  The VIP Check-In Desk will open at 9:30 a.m.</p>
<?php
		}
?>
			<p class="disclaimer">For your convenience, a confirmation ticket has been created and may be retrieved from the link below. To expedite check-in, please bring this ticket with you to the event.</p>
			</td>
          </tr>
        <tr>
          <td height="45" align="center"><input type="submit" name="Submit" value="Confirmation Ticket" />
<?php
		//Prime the ticket generation
		$ticketlink = "document=nab-2007-ticket.svg&fullname=".$fullname."&company=".$chrCompany."&barcode_value=".$BarNumber."&barcode_string=".$BarString."&";
		
		if ($_POST['idType'] == 2) { //VIP email
			$ticketlink .= "type=VIP Ticket";
		} else if ($_POST['idType'] == 3) { //Media email
			$ticketlink .= "type=Media Ticket";
		} else { //This is all others (General)
			$ticketlink .= "type=Guest Ticket";
		}
?>
		  	<input type="hidden" name="data" value="<?=bin2hex(encrypt_parameter_string($ticketlink));?>">
        </tr>
        <tr>
          <td>
<?php
		//General Disclaimer
		if ($_POST['idType'] == 1) {
?>
		  	<p class="disclaimer">Registration for this event will open at 9:30 a.m. &nbsp;We do expect the room to reach full capacity. &nbsp;Seating is on a first come first serve basis, and while we will try our best to accommodate, we do not guarantee admission if you arrive late for the presentation.</p>
<?php
		}
?>
		  	<p class="disclaimer"><strong>Please Note</strong>: If you are unable to attend this event, please click <a href="http://nab2007.itechit.com/cancel.php?idAttendee=<?php echo"{$chrSpecial}"?>">here</a> to cancel.</p>
		  	<p class="disclaimer">We look forward to seeing you at NAB 2007!</p>
		  	<p class="disclaimer">Apple Events</p></td>
        </tr>
<?php
	} else { // Waitlist text information
?>
		<tr>
          <td width="100%" class="title">Waitlist Confirmation</td>
          </tr>
        <tr>
          <td><p class="disclaimer">Unfortunately, registration is now full. We have added your name to our wait list and if space becomes available, we will contact you by email.</p>
		  	<p class="disclaimer">** NOTE: THIS IS NOT A CONFIRMATION.</p>
			<p class="disclaimer">** IF SEATING BECOMES AVAILABLE, YOUR REGISTRATION WILL BE CONFIRMED BY EMAIL.</p>
			<p class="disclaimer">Best Regards,</p>
			<p class="disclaimer">Apple Events</p>
			</td>
          </tr>
<?php
	} //End of choice for the waitlist
?>
        <tr>
          <td class="disclaimer">&nbsp;</td>
          </tr>
        <tr>
          <td class="disclaimer"><a href="http://www.apple.com/legal/privacy/">Apple Privacy Policy</a> <br />
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
</body>
</html>

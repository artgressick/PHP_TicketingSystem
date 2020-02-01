<?
	#This is the page for the Email. The only logic for this page is the Email Type.

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
?>
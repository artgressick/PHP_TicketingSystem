<?php	# Script 1.0 - Insert Profile
	
	// Check the posting of the page to make sure is was not by-passed.
	if (isset($_POST['Submit'])) {
		
		// **************************************
		// Get the information from the form.
		//
		$idEvent = 1;
		$idStatus = 1;
		$idType = $_REQUEST['idType']; //1 is general, 2 is VIP, 3 is WWDR, 4 is Apple Corp, 5 is Press
		$chrFirst = $_POST['chrFirst'];
		$chrLast = $_POST['chrLast'];
		$chrCompany = $_POST['chrCompany'];
		$chrTitle = $_POST['chrTitle'];
		$chrAddress1 = $_POST['chrAddress1'];
		$chrAddress2 = $_POST['chrAddress2'];
		$chrAddress3 = $_POST['chrAddress3'];
		$chrCity = $_POST['chrCity'];
		$chrState = $_POST['chrState'];
		$chrPostalCode = $_POST['chrPostalCode'];
		$chrCountry = $_POST['chrCountry'];
		$chrPhone = $_POST['chrPhone'];
		$chrEmail = $_POST['chrEmail'];
		$chrWWDR = $_POST['chrWWDR'];
		$chrDivisionDepartment = $_POST['chrDivisionDepartment'];
		$chrContact = $_POST['chrContact'];
		//-----------------------------------------------
		//Questions
		$Q1 = $_POST['Q1'];
		$Q2 = $_POST['Q2'];
		$Q3 = $_POST['Q3'];
		
		// Open the connection to the database
		require_once ('includes/mysql_connect.php'); //Map the Connection.
	
		// Insert the record into the database.
		$query1 = "INSERT INTO attendees (idEvent, idType, chrFirst, chrLast, chrCompany, chrTitle, chrAddress1, chrAddress2, chrAddress3, chrCity, chrState,
			chrPostalCode, chrCountry, chrPhone, chrEmail, chrWWDR, chrDivisionDepartment, chrContact, idStatus, Q1, Q2, Q3)
			VALUES ('".$idEvent."','".$idType."','".$chrFirst."','".$chrLast."','".$chrCompany."','".$chrTitle."','".$chrAddress1."','".$chrAddress2."',
			'".$chrAddress3."','".$chrCity."','".$chrState."','".$chrPostalCode."','".$chrCountry."','".$chrPhone."','".$chrEmail."','".$chrWWDR."','".$chrDivisionDepartment."','".$chrContact."','".$idStatus."',
			'".$Q1."','".$Q2."','".$Q3."')";
		
		$attendee = @mysql_query($query1) or $errors[] = mysql_error();
		//Get the Attendee ID
		$idAttendee = @mysql_insert_id() or $errors[] = mysql_error();
		
		//We need to make a special Hash
		$query1 = "UPDATE attendees SET chrSpecial = PASSWORD('".$idAttendee."') WHERE idAttendee = '".$idAttendee."'";
		$working = @mysql_query($query1) or $errors[] = mysql_error();
		
		//checkin the new person.
		$query1 = "INSERT into checkin(idAttendee) VALUES('".$_REQUEST['idAttendee']."')";
		$result1 = @mysql_query ($query1); //Run the query.
		
		mysql_close(); //Close the MY_SQL Connection

		//Get the right thank you
		include('includes/thankyou.php');
		
	} //This is from the submit section
?>
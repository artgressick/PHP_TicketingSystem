<?php

	require_once ('includes/mysql_connect.php');

	// turn the badge number scanned into a simple number
	$chrBadge =  ltrim(substr($_REQUEST['chrBadge'], 6, -3), '0');

	// get the attendee specified by the badge that was scanned
	$query = "SELECT ID, chrFirst, chrLast
	FROM attendees
	WHERE ID='" . $chrBadge . "'";
	$result = @mysql_query($query) or die('get attendee: ' . mysql_error());
	$attendee = mysql_fetch_assoc($result);

	if(!$attendee) {
		die('Badge number ' . htmlentities($chrBadge) . ' was not found.');
	}
	
	//Check to make sure there aren't more then 1 records for the checkin
	$query1 = "SELECT ID
	FROM checkin
	WHERE ID = '".$attendee['idAttendee']."'";
	$result = @mysql_query($query1) or die('get attendee: ' . mysql_error());
	//check it
	if (mysql_num_rows($result)) { //records found
		require_once ('includes/bad.php');
	} else { //No records
		$query1 = "INSERT into checkin SET idAttendee='" . $attendee['idAttendee'] . "'";
		$result1 = @mysql_query($query1) or die('insert checkin: ' . mysql_error());
		require_once ('includes/good.php');
	}
?>
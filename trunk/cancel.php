<?php
	$BF = "";
	require('_lib.php');
	
	// Check the posting of the page to make sure is was not by-passed.
	if ($_REQUEST['idAttendee']) {
		
		//We need to make a special Hash		
		$q = "UPDATE attendees SET idStatus = 3 WHERE chrSpecial = '".$_REQUEST['idAttendee']."'";
		database_query($q,"update cancellation code");
		
		
		//Get their email information so we can send them an email
		$q = "SELECT chrFirst, chrLast, chrEmail FROM attendees WHERE chrSpecial = '".$_REQUEST['idAttendee']."'";

		$attendee = mysqli_fetch_assoc(database_query($q,"update cancellation"));
		
		$chrFirst = $attendee['chrFirst'];
		$chrLast = $attendee['chrLast'];
		$chrEmail = $attendee['chrEmail'];
		
		//build the email.
		$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
		//----
		$Subject = "Cancellation: NAB 2007 Apple Special Event";
		//----
		$Message = "Dear $chrFirst $chrLast,\n\n";
		$Message .= "You have successfully cancelled you reservation to attend the NAB 2007 Apple Special Event.\n\n";
		$Message .= "Regards,\n";
		$Message .= "Apple Events\n";
		
		mail($chrEmail, $Subject, $Message, $Headers);
	}
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
    <td width="786" bgcolor="#3F3F3F"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" class="title">Cancel Registration</td>
          </tr>
<?php
	
	//Check to see if there was an error
	if ($attendee) {
?>
        <tr>
          <td><p class="disclaimer">Your cancellation for Apple Special Event at NAB 2007 has been confirmed.</p>
            <p class="disclaimer">Thank you for your interest.</p>
            <p class="disclaimer">Apple Events  </p></td>
          </tr>
<?php
	} else {
?>
		<tr>
          <td><p class="disclaimer">There was an error, please refer to your email and try again.</p></td>
          </tr>
<?php
	}
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

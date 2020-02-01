<?php
	$BF = "../";
	include($BF.'_lib.php');
	
	// Check the posting of the page to make sure is was not by-passed.
	if (isset($_POST['Submit'])) {
		
		// **************************************
		// Get the information from the form.
		//
		$idStatus = $_POST['idStatus'];
		$idOrgStatus = $_POST['idOrgStatus']; //This is the original Status from the User
		$idType = $_POST['idType']; //1 is general, 2 is VIP, 3 is WWDR, 4 is Apple Corp
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
		$chrContact = $_POST['chrContact'];
		$chkResend = $_POST['chkResend']; //Will be Yes is checked
		$chrSpecial = $_POST['chrSpecial'];
		$idAttendee = $_REQUEST['id']; //This is the Attendee ID


		
		// Insert the record into the database.
		$query1 = "UPDATE attendees SET
			idType = '".$idType."',
			chrFirst = '".$chrFirst."',
			chrLast = '".$chrLast."',
			chrCompany = '".$chrCompany."',
			chrTitle = '".$chrTitle."',
			chrAddress1 = '".$chrAddress1."',
			chrAddress2 = '".$chrAddress2."',
			chrAddress3 = '".$chrAddress3."',
			chrCity = '".$chrCity."',
			chrState = '".$chrState."',
			chrPostalCode = '".$chrPostalCode."',
			chrCountry = '".$chrCountry."',
			chrPhone = '".$chrPhone."',
			chrEmail = '".$chrEmail."',
			chrContact = '".$chrContact."',
			idStatus = '".$idStatus."'
			WHERE ID = '".$_REQUEST['id']."'";
			
		database_query($query1,"Saving Attendee Information");


		$q = "INSERT checkin (idAttendee) VALUES('".$_REQUEST['id']."')";
		
		database_query($q,"Checking Attendee In");		

	}
	
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
     <td bgcolor="#3F3F3F"><form name="form1" method="post" action="checklogon.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td id=cont><table width="100%"  border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td class="title">Checkin Attendee/Update Complete</td>
            </tr>
            <tr>
              <td><span style="font-size: 12px"></span></td>
            </tr>
            <tr>
              <td align="center" class="title"><a href="index.php"><span style="color:#CCCCCC;">Return to Attendees</span></a></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
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

<?php
	$BF = "../";
	include('../_lib.php');
	
	$count = 0;
	
	//Check for idUser
	if ($_SESSION['idUser'] == '') {
		header("Location: login.php");
		die();
	}
	
	//Check for a post
	if(isset($_POST['chrSubject'])) { // When doing isset, use a required field.  Faster than the php count funtion.
	
		$q = "SELECT ID, chrFirst, chrLast, chrEmail, chrSpecial, chrCompany
			FROM attendees";
			if($_POST['filterstatus'] != "" || $_POST['filtertypes'] != "") {
				$where = "";
				if($_POST['filterstatus'] != "") {
					$where .= " idStatus=". $_POST['filterstatus'];
				}
				if($_POST['filtertypes'] != "") {
					$where .= ($where != "" ? ' AND ' : '')." idType=". $_POST['filtertypes'];
				}
				$q .= " WHERE ". $where;
			}
			
			$q .= " ORDER by chrLast, chrFirst
		";
		
		//If the Admin checked the Box at the top then we need to make sure and only get a single email out
		if ($_POST['chkSingle'] == 1) {
			$q .= " LIMIT 3";
		}
		
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
		//Build the Static information for the emails
		$Headers = "From:rsvp_events@apple.com\r\n"; // This is from
		$Subject = $_POST['chrSubject'];
		$Message = $_POST['txtMessage'];
		
		$Message .= "\n\n";
		$Message .= "Confirmation Ticket: (You may have to copy and paste link in browser)\n";
		
		$MessageFooter = "We look forward to seeing you at NAB 2007!\n\n";
		$MessageFooter .= "Apple Events\n\n\n";
		
		
		//Populate and send the emails
		$result = database_query($q,"Get the search results");
		while ($row = mysqli_fetch_assoc($result)) {
		
			$count = $count + 1;
		
		//--Build the Values to make the PDF
			$ID = $row['ID'];
			$chrFirst = stripslashes($row['chrFirst']);
			$chrLast = stripslashes($row['chrLast']);
			if ($_POST['chkSingle'] == 1) {
				$chrEmail = "heather@apple.com";
			} else {
				//$chrEmail = $row['chrEmail'];
				$chrEmail = $row['chrEmail'];
			}
			
			$chrCompany = stripslashes($row['chrCompany']);
			$chrSpecial = $row['chrSpecial'];
		
			$BarNumber = sprintf("%09d", $ID)."000"; //Make a 9 digit
			$BarString = $chrLast.",".$chrFirst;
			$Postfullname = $chrFirst." ".$chrLast;
			$fullname = $chrFirst."+".$chrLast;
			
		//--Start to build the email
			
			$MessageSal = "Hello $chrFirst $chrLast,\n\n";
			$MessageDynamic = make_encrypted_url("document=nab-2007-ticket.svg&fullname=$fullname&company=$chrCompany&barcode_value=$BarNumber&barcode_string=$BarString&type=Guest Ticket");
			$MessageDynamic .= "\n\n";
			$MessageDynamic .= "If you are unable to attend this event, please cancel your registration online: http://nab2007.itechit.com/cancel.php?idAttendee=$chrSpecial\n\n\n";
			
			//Concat the message
			$Body = $MessageSal.$Message.$MessageDynamic.$MessageFooter;
			
			//Send this email for the waitlist to confirmed people
			mail($chrEmail, $Subject, $Body, $Headers);
			
			//This is the email testing section
			//$chrEmail2 = "agressick@techitsolutions.com";
			//mail($chrEmail2, $Subject, $Body, $Headers);
			
		} //End the email loop
		
	//---Give us a page that look good		
	}
	
	$types = database_query("SELECT * FROM types ORDER by chrType","Insert into attendees");
	$status = database_query("SELECT * FROM status ORDER by chrStatus","Insert into attendees");

	
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
          <td class="title">Send Emails <span style="font-size:10px; color:#FFFFFF;">(<?=$count?> emails sent)</span></td>
        </tr>
        <tr>
          <td><div id='errors'></div></td>
        </tr>
		<tr>
          <td>
		  	<div style="background-color:#CCCCCC; margin-bottom:5px; margin-top:2px; font-size:11px;"><input type="checkbox" name="chkSingle" value="1" /> 
			Send only to heather@apple.com for testing purposes.</div>
		  </td>
        </tr>
        <tr>
          <td><span class="textboxname">Filter</span><br />
						<select class='FormField' id="filtertypes" name='filtertypes'>
							<option value='%'>All Types</option>
						<? while ($row = mysqli_fetch_assoc($types)) { ?>
							<option value='<?=$row['ID']?>'><?=$row['chrType']?></option>
						<?	} ?>
						</select>
						 <span class="textboxname"> AND </span>
						<select class='FormField' id="filterstatus" name='filterstatus'>
							<option value='%'>All Status</option>
						<? while ($row = mysqli_fetch_assoc($status)) { ?>
							<option value='<?=$row['ID']?>'><?=$row['chrStatus']?></option>
						<?	} ?>
						</select>						


			</td>
        </tr>			
        <tr>
          <td><span class="textboxname">Subject</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrSubject" type="text" class="formfield" id="chrSubject" size="60" /></td>
        </tr>
		<tr>
          <td><span class="textboxname">Message</span> <span class="textboxrequired">(Required)</span> <br />
			<textarea name="txtMessage" cols="90" rows="20" wrap="virtual" id="txtMessage"></textarea></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="button" name="Submit" value="Send Email" onclick='error_check();' /></td>
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

		total += ErrorCheck('chrSubject', "You must enter a Subject for the Message.");
		total += ErrorCheck('txtMessage', "You must enter information into the Body of the email.");

		if(total == 0) { document.getElementById('form1').submit(); }
	}
</script>
</body>
</html>

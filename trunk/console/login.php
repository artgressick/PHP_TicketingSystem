<?php
	$BF = "../";
	include('includes/meta.php');
	include('includes/top.php');
	
	//Check the posting of the page to make sure is was not by-passed
	if (isset($_POST['chrEmail'])) {
		
		include('../_lib.php');
	
		//Search for the username and password in the user directory
		$q = "SELECT idUser FROM users WHERE chrUsername = '".$_POST['chrEmail']."' AND chrPassword = SHA1('".$_POST['chrPassword']."')";
		
		$user = mysqli_fetch_assoc(database_query($q,"look up user"));
		
		if ($user['idUser'] != '') {
			//They have a profile so take them to the homepage
			$_SESSION['idUser'] = $user['idUser']; //User id
			header ("Location: index.php"); //Goto the homepage
			die();
		}
	}
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
          <td colspan="2" class="title">Administration Section  </td>
          </tr>
        <tr>
          <td colspan="2"><div id='errors'></div></td>
          </tr>

        <tr>
          <td width="50%"><span class="textboxname">Username </span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrEmail" type="text" class="formfield" id="chrEmail" size="35" /></td>
          <td width="50%"><span class="textboxname">Password</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrPassword" type="password" class="formfield" id="chrPassword" size="35" /></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="button" name="Submit" value="Login" onclick='error_check();' />
		  <input type="hidden" name="idType" value="1" /></td>
          </tr>
        <tr>
          <td colspan="2" class="disclaimer">&nbsp;</td>
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

		total += ErrorCheck('chrEmail', "Please enter your email address.");
		total += ErrorCheck('chrPassword', "Please enter the password give to you.");

		if(total == 0) { document.getElementById('form1').submit(); }
	}
</script>
</body>
</html>

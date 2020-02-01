<?php
	$BF = "";
?>
<?
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
    <td width="786" bgcolor="#3F3F3F"><form id="form1" name="form1" method="post" action="thankyou.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" class="title">Registration Error </td>
          </tr>
        <tr>
          <td height="35">&nbsp;</td>
          </tr>
        <tr>
          <td class="blurbtitle">We are sorry but you or someone else has already registered with this email address. Please check your email to see if you have already received an email.</td>
          </tr>
        <tr>
          <td height="35">&nbsp;</td>
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
<script language="JavaScript" src="includes/forms.js"></script>
<script language="javascript">
	function error_check() {
		if(total != 0) { reset_errors(); }  

		var total=0;

		total += ErrorCheck('chrFirst', "You must enter a First Name.");
		total += ErrorCheck('chrLast', "You must enter a Last Name.");
		total += ErrorCheck('chrCompany', "You must enter an Company Name.");
		total += ErrorCheck('chrTitle', "You must enter a Title.");
		total += ErrorCheck('chrEmail', "You must enter an Email Address.","email");

		if(total == 0) { document.getElementById('form1').submit(); }
	}
</script>
</body>
</html>

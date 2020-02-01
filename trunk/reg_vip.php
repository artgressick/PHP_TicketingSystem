<?php
	$BF = "";
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
          <td colspan="2" class="title">VIP Registration</td>
          </tr>
        <tr>
          <td colspan="2"><div id='errors'></div></td>
          </tr>
        <tr>
          <td width="50%"><span class="textboxname">First Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrFirst" type="text" class="formfield" id="chrFirst" size="35" /></td>
          <td width="50%"><span class="textboxname">Last   Name</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrLast" type="text" class="formfield" id="chrLast" size="35" /></td>
        </tr>
        <tr>
          <td width="50%"><span class="textboxname">Company Name</span> <span class="textboxrequired">(Required)</span> <br />
            <input name="chrCompany" type="text" class="formfield" id="chrCompany" size="35" /></td>
          <td width="50%"><span class="textboxname">Title</span> <span class="textboxrequired">(Required)</span><br />
            <input name="chrTitle" type="text" class="formfield" id="chrTitle" size="35" /></td>
        </tr>
        <tr>
          <td><span class="textboxname">Email Address </span> <span class="textboxrequired">(Confirmation will be sent to this address)</span><br />
            <input name="chrEmail" type="text" class="formfield" id="chrEmail" size="35" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="checkbox" name="checkbox" value="Yes" />
            <span class="disclaimer">Stay in touch! Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products.</span></td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><input type="button" name="Submit" value="Register for this Special Event" onclick="error_check();" />
		  <input type="hidden" name="idType" value="2" /></td>
          </tr>
        <tr>
          <td colspan="2" class="disclaimer">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2" class="disclaimer"><a href="http://www.apple.com/legal/privacy/">Apple Privacy Policy</a> <br />
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

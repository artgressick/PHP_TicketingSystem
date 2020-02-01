<?php
	$BF = "../";
	include('../_lib.php');

	
	//Check for idUser
	if ($_SESSION['idUser'] == '') {
		header("Location: login.php");
		die();
	}
	
	//Count the Total General
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE idType = 1 AND idStatus = 1 AND idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count General"));
	$intGeneral = $count['intGeneral'];
	
	//Count the VIP
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE idType = 2 and idStatus = 1 and idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count VIP"));
	$intVIP = $count['intGeneral'];
	
	//Count the Press
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE idType = 3 and idStatus = 1 and idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count Press"));
	$intPress = $count['intGeneral'];
	
	//Count the Total Apple
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE idType = 4 and idEvent = 3 and idStatus = 1";
		
	$count = mysqli_fetch_assoc(database_query($q,"count Apple"));
	$intApple = $count['intGeneral'];
	
	//Count the Contact
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE chrContact = 'Yes' and idStatus = 1 and idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count Contact"));
	$intContact = $count['intGeneral'];
	
	//Count the Cancelled
	$q = "SELECT count(ID) as intGeneral FROM attendees WHERE idStatus = 3 and idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count Cancelled"));
	$intCancelled = $count['intGeneral'];
	
	//Count the Total Ceckin
	$q = "SELECT count(checkin.idAttendee) as intCheckin FROM checkin JOIN attendees ON attendees.ID = checkin.idAttendee WHERE attendees.idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count Checkin"));
	$intCheckin = $count['intCheckin'];
	
	//Count the Total General
	$q = "SELECT count(checkin.idAttendee) as intCVIP FROM checkin
	JOIN attendees ON checkin.idAttendee = attendees.ID where idStatus = 1 and idType = 2 and idEvent = 3";
		
	$count = mysqli_fetch_assoc(database_query($q,"count VIP Checkin"));
	$intVIPCheckin = $count['intCVIP'];
	
	
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
    <td width="786" bgcolor="#3F3F3F"><form id="form1" name="form1" method="post" action="search.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" class="title">Administration Stats </td>
          <td width="50%" align="right" class="title"><span class="topbannerlinks"><a href="index.php">Quick Counts</a> | <a href="sendemails.php">Send Emails</a> | <a href="excel.php">Export to Excel</a></span></td>
        </tr>
        <tr>
          <td colspan="2"><div id='errors'>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td align="right" class="adminbar">Status</td>
                      <td class="adminbar"><select name="idStatus" size="1" id="idStatus">
                          <option value="0">All</option>
                          <option value="1">Confirmed</option>
                          <option value="2">Waitlist</option>
                          <option value="3">Cancelled</option>
                      </select>                      </td>
                      <td align="right" class="adminbar">Group</td>
                      <td class="adminbar"><select name="idType" size="1" id="idType">
                          <option value="0">All</option>
                          <option value="1">General</option>
                          <option value="2">VIP</option>
                          <option value="3">Press</option>
						  <option value="4">Apple</option>
                      </select>                      </td>
                      <td align="right" class="adminbar">Search</td>
                      <td class="adminbar"><input name="chrSearch" type="text" id="chrSearch" size="20" /></td>
                      <td class="adminbar"><input type="submit" name="Submit2" value="Filter" /></td>
                  </tr>
              </table>
          </div></td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td nowrap="nowrap" class="statslabel">Total General </td>
                  <td width="50%" class="statsoutput"><?=$intGeneral?></td>
                  <td nowrap="nowrap" class="statslabel">Total Yes Contact </td>
                  <td width="50%" class="statsoutput"><?=$intContact?></td>
              </tr>
              <tr>
                  <td nowrap="nowrap" class="statslabel">Total VIP </td>
                  <td class="statsoutput"><?=$intVIP?></td>
                  <td nowrap="nowrap" class="statslabel">Total Cancelled </td>
                  <td class="statsoutput"><?=$intCancelled?></td>
              </tr>
              <tr>
                  <td nowrap="nowrap" class="statslabel">Total Press </td>
                  <td class="statsoutput"><?=$intPress?></td>
                  <td nowrap="nowrap" class="statslabel">Total Checkin </td>
                  <td class="statsoutput"><?=$intCheckin?></td>
              </tr>
              <tr>
                  <td class="statslabel">Total Apple </td>
                  <td class="statsoutput"><?=$intApple?></td>
                  <td nowrap="nowrap" class="statslabel">Total VIP Checkin </td>
                  <td class="statsoutput"><?=$intVIPCheckin?></td>
              </tr>
			  <tr>
                  <td class="statslabel">Total People </td>
                  <td class="statsoutput" colspan="3"><?=$intVIP+$intGeneral+$intPress+$intApple?></td>
              </tr>
          </table></td>
          </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
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
</body>
</html>

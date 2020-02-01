<?php
	$BF = "../";
	include('../_lib.php');
		
	//Check for idUser
	if ($_SESSION['idUser'] == '') {
		header("Location: login.php");
		die();
	}
	
	if(count($_POST)) {
		$_SESSION['consoleStatus'] = $_POST['idStatus'];
		$_SESSION['consoleGroup'] = $_POST['idType'];
		$_SESSION['consoleSearch'] = $_POST['chrSearch'];
	} else { 
		if(!isset($_SESSION['consoleStatus'])) { $_SESSION['consoleStatus'] = ""; }
		if(!isset($_SESSION['consoleGroup'])) { $_SESSION['consoleGroup'] = ""; }
		if(!isset($_SESSION['consoleSearch'])) { $_SESSION['consoleSearch'] = ""; }
	}
	
	//Prime the variables
	$typeswitch = FALSE;
	$intRecords = 0;
	if(!isset($_REQUEST['sortCol'])) { $_REQUEST['sortCol'] = "chrLast, chrFirst"; }
	
	//Search for attendees
	$q = "SELECT attendees.ID, chrStatus, chrType, chrFirst, chrLast, chrCompany, chrTitle, chrAddress1, chrAddress2, 
		chrAddress3, chrCity, chrState, chrPostalCode, chrCountry, chrPhone, chrEmail, chrContact, 
		Q1, Q2, Q3, Q4a, Q4b, Q4c, Q4d, Q4e, Q4f, 
		DATE_FORMAT(dtStamp,'%W, %M %D, %Y') as dtDate, DATE_FORMAT(dtStamp, '%h:%i %p') as dtTime
		FROM attendees 
		JOIN status ON attendees.idStatus = status.ID
		JOIN types ON attendees.idType = types.ID		
		WHERE idEvent = 3 and (lower(chrFirst) LIKE '%" . $_SESSION['consoleSearch'] . "%' OR 
		lower(chrLast) LIKE '%" . $_SESSION['consoleSearch'] . "%' OR lower(chrCompany) LIKE '%" . $_SESSION['consoleSearch'] . "%') ";
	
	//Check for the Type
	if ($_SESSION['consoleGroup'] > 0) {
		$typeswitch = TRUE;
		$q .= "AND idType = '".$_SESSION['consoleGroup']."' ";
	}
	//Check for the Status
	if ($_SESSION['consoleStatus'] > 0) {
		if ($typeswitch) {
			$q .= "AND idStatus = '".$_SESSION['consoleStatus']."' ";
		} else {
			$q .= "AND idStatus = '".$_SESSION['consoleStatus']."' ";
		}
	}
	
	$q .= "ORDER BY " . $_REQUEST['sortCol'] . " " . $_REQUEST['ordCol'];
	
	$_SESSION['consoleSearchQuery'] = $q;
	
	$result = database_query($q,"Get the search results");
	
	
	include('includes/meta.php');
	include($BF.'components/list/sortlist.php');
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
          <td width="50%" align="right" class="title"><span class="topbannerlinks"><a href="index.php">Quick Counts</a> | <a href="sendemails.php">Send Emails</a> | <a href="excel.php">Export Results to Excel</a></span></td>
        </tr>
        <tr>
          <td colspan="2">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td align="right" class="adminbar">Status</td>
                      <td class="adminbar"><select name="idStatus" size="1" id="idStatus">
                          <option value="0"<?=($_SESSION['consoleStatus'] == 0 ? ' selected' : '')?>>All</option>
                          <option value="1"<?=($_SESSION['consoleStatus'] == 1 ? ' selected' : '')?>>Confirmed</option>
                          <option value="2"<?=($_SESSION['consoleStatus'] == 2 ? ' selected' : '')?>>Waitlist</option>
                          <option value="3"<?=($_SESSION['consoleStatus'] == 3 ? ' selected' : '')?>>Cancelled</option>
                      </select>                      </td>
                      <td align="right" class="adminbar">Group</td>
                      <td class="adminbar"><select name="idType" size="1" id="idType">
                          <option value="0"<?=($_SESSION['consoleGroup'] == 0 ? ' selected' : '')?>>All</option>
                          <option value="1"<?=($_SESSION['consoleGroup'] == 1 ? ' selected' : '')?>>General</option>
                          <option value="2"<?=($_SESSION['consoleGroup'] == 2 ? ' selected' : '')?>>VIP</option>
                          <option value="3"<?=($_SESSION['consoleGroup'] == 3 ? ' selected' : '')?>>Press</option>
						  <option value="4"<?=($_SESSION['consoleGroup'] == 4 ? ' selected' : '')?>>Apple</option>
                      </select>                      </td>
                      <td align="right" class="adminbar">Search</td>
                      <td class="adminbar"><input name="chrSearch" type="text" id="chrSearch" size="20" value="<?=$_SESSION['consoleSearch']?>" /></td>
                      <td class="adminbar"><input type="submit" name="Submit2" value="Filter" /></td>
                  </tr>
              </table>
          </td>
          </tr>
        <tr>
          <td colspan="2">
		  	<table id='List' class='List' style='width: 100%;' cellpadding="0" cellspacing="0">
				<tr>
					<? sortList('Last Name', 'chrLast'); ?>
					<? sortList('First Name', 'chrFirst'); ?>
					<? sortList('Company', 'chrCompany'); ?>
					<? sortList('Type', 'chrType'); ?>
					<? sortList('Status', 'chrStatus'); ?>
				</tr>
<? 
	$count=0;
	
	while ($row = mysqli_fetch_assoc($result)) {
		$link = 'location.href="editattendee.php?id='. $row["ID"] .'";';
?>
				<tr id='tr<?=$row['ID']?>' class='<?=($count++%2?'ListLineOdd':'ListLineEven')?>' 
					onmouseover='RowHighlight("tr<?=$row['ID']?>");' onmouseout='UnRowHighlight("tr<?=$row['ID']?>");'>
					<td style='cursor: pointer;' onclick='<?=$link?>'><?=$row['chrLast']?></td>
					<td style='cursor: pointer;' onclick='<?=$link?>'><?=$row['chrFirst']?></td>
					<td style='cursor: pointer;' onclick='<?=$link?>'><?=$row['chrCompany']?></td>	
					<td style='cursor: pointer;' onclick='<?=$link?>'><?=$row['chrType']?></td>	
					<td style='cursor: pointer;' onclick='<?=$link?>'><?=$row['chrStatus']?></td>	
				</tr>
<?
	}
?>
			</table>
			<div style='padding: 3px; border: 1px solid gray; border-top: none; text-align:left; font-size:11px; background:#000000; color:#FFFFFF'><?=$count?> Records Shown</div>
<?
	if($count == 0) {
?>
				<div style='padding: 3px; border: 1px solid gray; border-top: none; text-align:center; font-size:11px; background:#FFFFFF;'>No records to display</div>
<?
	}
?>
		  </td>
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

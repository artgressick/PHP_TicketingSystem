<?php
	$BF = "../";
	include($BF.'_lib.php');
	
	$intRecords = 0;
	(isset($_REQUEST['chrSearch']) ? $chrSearch = $_REQUEST['chrSearch'] : $chrSearch = "" );
	(!isset($_REQUEST['idStatus']) ? $_REQUEST['idStatus'] = "" : "" );
	(!isset($_REQUEST['idType']) ? $_REQUEST['idType'] = "" : "" );
	$chrDisplay = "TRUE";

	// This is for the sorting of the rows and columns.  We must set the default order and name
	include($BF. 'components/list/sortList.php'); 
	if(!isset($_REQUEST['sortCol'])) { $_REQUEST['sortCol'] = "chrLast"; }	
	if (($_REQUEST['idStatus'] != "") OR ($_REQUEST['idType'] != "") OR ($_REQUEST['chrSearch'] != "")) {
		//Do the Display
		//Make the original query
		$possiblebadge = ltrim(substr($chrSearch, 5, -3), '0');
		
		$query = "SELECT ID, chrFirst, chrLast, chrCompany, idStatus, idType, 
		(select DATE_FORMAT(dtStamp, '%h:%i %p') from checkin where checkin.idAttendee  = attendees.ID) as dtTime
		FROM attendees 
		WHERE idEvent = 3 AND
		((lower(chrFirst) LIKE '%" . $chrSearch . "%' 
		OR lower(chrLast) LIKE '%" . $chrSearch . "%' 
		OR lower(chrCompany) LIKE '%" . $chrSearch . "%')
		OR (ID = '" . $possiblebadge ."')) ";
	
		//Check for the Type
		if ($_REQUEST['idType'] > 0) {
			$query .= "AND idType = '".$_REQUEST['idType']."'";
		}
		//Check for the Status
		switch ($_REQUEST['idStatus']) {
			case 1: // Checked In
				$query .= "AND ID in (select idAttendee from checkin)";
				break;
			case 2:
				$query .= "AND ID not in (select idAttendee from checkin)";
				break;
		}
	
		//This is where we need to do the sorting
		$query .= " ORDER BY " . $_REQUEST['sortCol'] . " " . $_REQUEST['ordCol'];
		
		$result = database_query($query,"Running Query");
		} else {
		//Dont display anything
		$chrDisplay = "FALSE";
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
    <td bgcolor="#3F3F3F">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td id=cont><form name="form1" method="post" action="index.php">
            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td class="title">Checkin Desk</td>
              </tr>
              <tr>
                <td colspan="2">
					<table width="100%"  border="0" cellspacing="0" cellpadding="3">
					  <tr>
						<td align="right" class="adminbar">Status</td>
						<td class="adminbar">
						  <select name="idStatus" size="1" id="idStatus">
							  <option value="0" <?php if ($_REQUEST['idStatus'] == 0) { echo "selected"; }?>>All</option>
							  <option value="1" <?php if ($_REQUEST['idStatus'] == 1) { echo "selected"; }?>>Checked In</option>
							  <option value="2" <?php if ($_REQUEST['idStatus'] == 2) { echo "selected"; }?>>Not Checked In</option>
						  </select>
						</td>
						<td align="right" class="adminbar">Group</td>
						<td class="adminbar">
						  <select name="idType" size="1" id="idType">
							<option value="0" <?php if ($_REQUEST['idType'] == 0) { echo "selected"; }?>>All</option>
							<option value="1" <?php if ($_REQUEST['idType'] == 1) { echo "selected"; }?>>General</option>
							<option value="2" <?php if ($_REQUEST['idType'] == 2) { echo "selected"; }?>>VIP</option>
							<option value="3" <?php if ($_REQUEST['idType'] == 3) { echo "selected"; }?>>Press</option>
							<option value="4" <?php if ($_REQUEST['idType'] == 4) { echo "selected"; }?>>Apple</option>
						  </select>
						</td>
						<td align="right" class="adminbar">Search</td>
						<td class="adminbar"><input name="chrSearch" type="text" class="style1" id="chrSearch" size="25" maxlength="30" value="<?php echo"{$chrSearch}";?>"></td>
						<td class="adminbar"><input name="Submit" type="submit" value="Filter"></td>
					  </tr>
					</table>
				</td>
              </tr>
			  <? if ( $chrDisplay == "TRUE" ) { ?>
			  <tr>
			  	<td>
					<div class='innerbody'>
						<table id='List' class='List' style='width: 100%;' cellpadding="0" cellspacing="0">
							<tr>			
								<? sortList('Name', 'chrLast'); ?>
								<? sortList('Group Type', 'idType'); ?>
								<? sortList('Company', 'chrCompany'); ?>
								<? sortList('Checked In', 'dtTime'); ?>
								<? sortList('Status', 'idStatus'); ?>			
							</tr>
					<? $count=0;	
					$intRecords = mysqli_num_rows($result);
					while ($row = mysqli_fetch_assoc($result)) { 
					
							switch ($row['idType']) {
								case 1:
									$chrType = "General";
									break;
								case 2:
									$chrType = "VIP";
									break;
								case 3:
									$chrType = "Press";
									break;
								case 4:
									$chrType = "Apple Corp";
									break;
								default:
									$chrType = "NA";
									break;
							}
							
							switch ($row['idStatus']) {
								case 1:
									$chrStatus = "Active";
									break;
								case 2:
									$chrStatus = "Cancelled";
									break;
								case 3:
									$chrStatus = "Wait List";
									break;
								default:
									$chrStatus = "NA";
									break;
							}					
					
					
					?>
								<tr id='tr<?=$row['ID']?>' class='<?=($count++%2?'ListLineOdd':'ListLineEven')?>' 
								onmouseover='RowHighlight("tr<?=$row['ID']?>");' onmouseout='UnRowHighlight("tr<?=$row['ID']?>");'>
									<? if ($row['dtTime'] == "") { ?>
									<td style='cursor: pointer;' onclick='location.href="viewattendee.php?id=<?=$row['ID']?>"'><?=$row['chrLast']?>, <?=$row['chrFirst']?></td>
									<? } else { ?>
									<td><?=$row['chrLast']?>, <?=$row['chrFirst']?></td>
									<? } ?>								
									<td><?=$chrType?></td>
									<td><?=$row['chrCompany']?></td>	
									<td><?=$row['dtTime']?></td>
									<td><?=$chrStatus?></td>					
								</tr>
					<?	} 
					if($count == 0) { ?>
								<tr>
									<td align="center" colspan='5' class='ListLineOdd'>No Users to display</td>
								</tr>
					<?	} ?>
							</table>
						</div>
					</td>
				</tr>
                <tr>
                  <td style="color:#CCCCCC;"><?=$intRecords?> People</td>
              	</tr>
				<? } ?>

            </table>
          </form></td>
        </tr>
      </table>
    </td>
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

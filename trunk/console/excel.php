<?php
	$NON_HTML_PAGE = true;
	$BF = "../";
	require_once "Spreadsheet/Excel/Writer.php";
	require($BF. '_lib.php');
	
	$q = $_SESSION['consoleSearchQuery'];
	$result = database_query($q, "getting results");

	// create workbook
	$workbook = new Spreadsheet_Excel_Writer();
	
	// send the headers with this name
	$workbook->send('attendees.xls');	
	
	// create format for column headers
	$format_column_header =& $workbook->addFormat();
	$format_column_header->setBold();
	$format_column_header->setSize(10);
	$format_column_header->setAlign('left');
	
	// create data format
	$format_data =& $workbook->addFormat();
	$format_data->setSize(10);
	$format_data->setAlign('left');
	
	// Create worksheet
	$worksheet =& $workbook->addWorksheet('Attendees');
	$worksheet->hideGridLines();
	
	$column_num = 0;
	$row_num = 0;
	
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Last Name', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 30);
	$worksheet->write($row_num, $column_num, 'First Title', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Company', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Type', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Status', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Email', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Country', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Date', $format_column_header);
	$column_num++;
	$worksheet->setColumn($column_num, $column_num, 25);
	$worksheet->write($row_num, $column_num, 'Time', $format_column_header);
	$column_num++;
	
	$row_num++;

	while($row = mysqli_fetch_assoc($result)) {
	
		$column_num = 0;
		
		$worksheet->write($row_num, $column_num, html_entity_decode(stripslashes($row['chrLast'])), $format_data);
		$column_num++;	
		$worksheet->write($row_num, $column_num, html_entity_decode(stripslashes($row['chrFirst'])), $format_data);
		$column_num++;	
		$worksheet->write($row_num, $column_num, html_entity_decode(stripslashes($row['chrCompany'])), $format_data);
		$column_num++;	
		$worksheet->write($row_num, $column_num, $row['chrType'], $format_data);
		$column_num++;	
		$worksheet->write($row_num, $column_num, $row['chrStatus'], $format_data);
		$column_num++;		
		$worksheet->write($row_num, $column_num, $row['chrEmail'], $format_data);
		$column_num++;
		$worksheet->write($row_num, $column_num, $row['chrCountry'], $format_data);
		$column_num++;
		$worksheet->write($row_num, $column_num, $row['dtDate'], $format_data);
		$column_num++;
		$worksheet->write($row_num, $column_num, $row['dtTime'], $format_data);
		$column_num++;
		
		$row_num++;
	}

	$workbook->close();
	?>
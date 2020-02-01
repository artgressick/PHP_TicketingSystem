
function create_console_window(BASE_FOLDER, error_dump)
{
	console = window.open('', 'errorConsole', 'resizable=yes,scrollbars=yes,directories=no,location=no,menubar=yes,status=yes,toolbar=yes');

	console.document.open();
	
	console.document.writeln('<html>\n' +
'		<head>\n' +
'			<title>Debug Console</title>\n' +
'			<link href="' + BASE_FOLDER + 'components/ErrorHandling/errorConsole.css" rel="stylesheet" type="text/css" />\n' +
'			<script type="text/javascript" src="' + BASE_FOLDER + 'components/ErrorHandling/errorConsole.js"></scr' + 'ipt>\n' +
'			</head>\n' + 
'		<body>\n');

	for(i in error_dump) {
		error = error_dump[i];
		console.document.writeln(
'			<div class="Item">\n' +
'				<div class="Toggle" onclick="console_toggle(this, \'Details\');">+</div>\n' +
'				<h1><span class="Level ' + error['Level'] + '">' + error['Level'] + '</span>\n' +
(error['Count']?'<span class="Count">' + error['Count'] + ' times:</span>\n':'') +
'					<span class="Message">' + error['Message'] + '</span>\n' +
'					<span class="File">' + error['File'] + '</span>\n' +
'					<span class="Line">' + error['Line'] + '</span></h1>\n' +
'				<div class="Details">\n' +
'					<div class="Toggle" onclick="console_toggle(this, \'Context\');">+</div>\n' +
'					<h2>Context</h2>\n' +
'					<div class="Context">' +
error['Context'] +
'</div>\n' +
'					<div class="Toggle" onclick="console_toggle(this, \'Backtraces\');">+</div>\n' +
'					<h2>Backtrace</h2>\n' +
'					<div class="Backtraces">\n' +
			'');

		for(j in error['Backtrace']) {
			var bt = error['Backtrace'][j];
			console.document.writeln(
'						<div class="Backtrace">\n' +
'							<div class="Toggle" onclick="console_toggle(this, \'BacktraceCode\');">+</div>\n' +
'							<h3><span class="Function">' + bt['Function'] + '</span>\n' +
'								<span class="File">' + bt['File'] + '</span>\n' +
'								<span class="Line">' + bt['Line'] + '</span>\n' +
'								</h3>\n' +
'							<div class="BacktraceCode">' +
				'');
			for(k in bt['ContextCode']) {
				console.document.writeln(
k + ': ' + bt['ContextCode'][k] + '' +
					'');
			}

			console.document.writeln(
'</div>\n' +
'							</div>\n' +
				'');
		}

		console.document.writeln(
'						</div>\n' +
'					</div>\n' +
'				</div>\n' +
			'');
    }
	console.document.writeln('</body>' + '</html>');
	console.document.close();
}

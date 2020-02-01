<?

define('E_USER_ALL',	E_USER_NOTICE | E_USER_WARNING | E_USER_ERROR);
define('E_NOTICE_ALL',	E_NOTICE | E_USER_NOTICE);
define('E_WARNING_ALL',	E_WARNING | E_USER_WARNING | E_CORE_WARNING | E_COMPILE_WARNING);
define('E_ERROR_ALL',	E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
define('E_NOTICE_NONE',	E_ALL & ~E_NOTICE_ALL);
define('E_DEBUG',		0x10000000);
if (version_compare(phpversion(),'5.0.0dev','>=')) {
	define('E_VERY_ALL',	E_ERROR_ALL | E_WARNING_ALL | E_NOTICE_ALL | E_DEBUG | E_STRICT);
} else {
	define('E_VERY_ALL',	E_ERROR_ALL | E_WARNING_ALL | E_NOTICE_ALL | E_DEBUG);
}

define('CONTEXT_CODE_LINES', '4');
$hidden_variables = array('hidden_variables', 'GLOBALS', '_errors');

$_errors = array();
error_reporting(E_VERY_ALL);
set_error_handler('_error_handler');
register_shutdown_function('_error_output');

if(defined('DEBUG_CONSOLE') && !($NON_HTML_PAGE || !isset($_SERVER['SERVER_NAME']))) {
	$DEBUG_METHOD = 'console';
	$DEBUG_LOG_LEVEL = E_VERY_ALL;
} else {
	$DEBUG_METHOD = 'mail';
	if(defined('DEBUG_MAIL_ALL_MESSAGES')) {
		$DEBUG_MAIL_LEVEL = E_VERY_ALL;
	} else {
		$DEBUG_MAIL_LEVEL = E_ERROR_ALL;
	}
	$DEBUG_LOG_LEVEL = E_VERY_ALL;
}

function _error_output()
{
	global $_errors, $json;
	global $DEBUG_METHOD, $DEBUG_MAIL_LEVEL;
	static $been_done = false;

	restore_error_handler();

	if($been_done) {
		return;
	}

	if(count($_errors) && $DEBUG_METHOD=='console') {
		_error_console();
		$_errors = array();
	} else if(count($_errors) && $DEBUG_METHOD=='mail') {
		$t = 0;
		foreach($_errors as $error) {
			if($error['Number'] & $DEBUG_MAIL_LEVEL) {
				$t++;
			}
		}

		if($t) {
			_error_send_mail();
		}
	}
	
	$been_done = true;
}

function _error_console()
{
	global $_errors, $json, $BF;

	$totals = array();
	foreach($_errors as $e) {
		@$totals[$e['Level']]++;
	}

	$t = array();
	foreach($totals as $type => $total) {
		$t[] = '<span class="ErCss' . $type . '">' . substr($type, 0, 1) . ':' . $total . '</span>';
	}
	set_time_limit(30);
?>
	<script type='text/javascript' src='<?=$BF?>components/ErrorHandling/error_handler.js'></script>
	<script type='text/javascript'>//<![CDATA[
		function debug_link_clicked()
		{
			 var error_dump = <?=$json->encode($_errors)?>;
			 create_console_window("<?=$BF?>", error_dump);
		}
	// ]]></script>
	<div class='ScreenOnly DebugLink'><a href='javascript://' onclick='debug_link_clicked();'>Debug (<?=implode(',', $t)?>)</a></div>
<?
}

function _error_send_mail()
{
	global $_errors, $json;
	ob_start();	
?>
		<style type='text/css'><? include('errorMail.css'); ?></style>

<?	foreach($_errors as $error) { ?>
		<h1><span class="Level <?=$error['Level']?>"><?=$error['Level']?></span>
			<span class="Message"><?=$error['Message']?></span>
			<span class="File"><?=$error['File']?></span>
			<span class="Line"><?=$error['Line']?></span></h1>
<?	} ?>

		<div class="Items">
<?	foreach($_errors as $error) { ?>
			<div class="Item">
				<h1><span class="Level <?=$error['Level']?>"><?=$error['Level']?></span>
					<span class="Message"><?=$error['Message']?></span>
					<span class="File"><?=$error['File']?></span>
					<span class="Line"><?=$error['Line']?></span></h1>
				<div class="Details">
					<h2>Context</h2>
					<div class="Context"><?=$error['Context']?>
						</div>
					<h2>Backtrace</h2>
					<div class="Backtraces">
<?		foreach($error['Backtrace'] as $bt) { ?>
						<div class="Backtrace">
							<h3><span class="Function"><?=$bt['Function']?></span>
								<span class="File"><?=$bt['File']?></span>
								<span class="Line"><?=$bt['Line']?></span>
								</h3>
							<div class="BacktraceCode"><?
			if(is_array($bt['ContextCode'])) {
				foreach($bt['ContextCode'] as $k => $v) {
					echo($k . ': ' . $v . "\n");
				}
			}
								?></div>
							</div>
<?		} ?>

						</div>
					</div>
				</div>
<?	} ?>
			</div>
		<pre><? print_r(array('SERVER' => $_SERVER, 'GET' => $_GET, 'POST' => $_POST, 'COOKIE' => $_COOKIE, 'SESSION' => (isset($_SESSION)?$_SESSION:'not set'))); ?></pre>
<?
	$Message = ob_get_contents();
	ob_end_clean();

	$totals = array();
	foreach($_errors as $e) {
		@$totals[$e['Level']]++;
	}

	$t = array();
	foreach($totals as $type => $total) {
		$t[] = '<span class="' . $type . '">' . substr($type, 0, 1) . ':' . $total . '</span>';
	}

	if(!isset($_SERVER['SERVER_NAME'])) {
		$server_name = `hostname` . ': ';
	} else {
		$server_name = $_SERVER['SERVER_NAME'];
	}
	$Subject = '[' . constant('APPLICATION_NAME') . '] (' . strip_tags(implode(',', $t)) . ') ' . $server_name . $_SERVER['SCRIPT_NAME'];

	$headers = 
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"";

	mail(constant('BUG_REPORT_ADDRESS'), $Subject, $Message, $headers);
}

function _error_debug($var, $name, $errline='', $errfile='', $errno=E_DEBUG)
{
	global $_errors;
	global $DEBUG_LOG_LEVEL;
	
	if(!($errno & $DEBUG_LOG_LEVEL)) {
		return;
	}

	$errcontext = array($name => $var);
	$errstr = $name;

	$new_error = array(
		'Number' => $errno,
		'Message' => $errstr,
		'File' => $errfile,
		'Line' => $errline,
		'Context' => trim(_varExport(_getCleanedContext($errcontext))),
		'Backtrace' => _getBackTrace(),
		);

	if ($errno & E_ERROR_ALL) {
		$new_error['Level'] = 'Error';
	} else if ($errno & E_WARNING_ALL) { 
		$new_error['Level'] = 'Warning';
	} else if ($errno & E_NOTICE_ALL) {
		$new_error['Level'] = 'Notice';
	} else if ($errno & E_DEBUG) {
		$new_error['Level'] = 'Debug';
	} else if ($errno & E_STRICT) {
		$new_error['Level'] = 'Strict';
	} else {
		$new_error['Level'] = '(unknown)';
	}
	
	if (version_compare(phpversion(),'5.1.0','<')) {
		array_unshift($new_error['Backtrace'], array(
			'File' => $errfile,
			'Line' => $errline,
			'ContextCode' => _getContextCode($errfile, $errline),
			'Function' => '[DEBUG]',
			));
	}

	$_errors[] = $new_error;
}


function _error_handler($errno, $errstr, $errfile, $errline, $errcontext)
{
	global $_errors;
	global $DEBUG_LOG_LEVEL;
	
	// if the statement uses an @, this will be true
	if (error_reporting() == 0) {
		return;
	}

	if(!($errno & $DEBUG_LOG_LEVEL)) {
		return;
	}
	
	$message = str_replace("href='function.", "target='_new' href='http://php.net/", $errstr);

	$new_error = array(
		'Number' => $errno,
		'Message' => $message,
		'File' => $errfile,
		'Line' => $errline,
	);
	
	// check this error against the most recent error
	if(count($_errors)) {
		$last_error = $_errors[count($_errors)-1];
		$match = true;
		foreach($new_error as $k => $v) {
			if($last_error[$k] != $v) {
				$match = false;
				break;
			}
		}
	}

	// if this error is the same as the previous, increment the previous
	if(@$match) {
		if(isset($last_error['Count'])) {
			$last_error['Count']++;
		} else {
			$last_error['Count'] = 2;
		}

		$_errors[count($_errors)-1] = $last_error;
		return;
	}

	$new_error['Context'] = htmlentities(trim(_varExport(_getCleanedContext($errcontext))));
	$new_error['Backtrace'] = _getBackTrace();

	if ($errno & E_ERROR_ALL) {
		$new_error['Level'] = 'Error';
	} else if ($errno & E_WARNING_ALL) { 
		$new_error['Level'] = 'Warning';
	} else if ($errno & E_NOTICE_ALL) {
		$new_error['Level'] = 'Notice';
	} else if ($errno & E_DEBUG) {
		$new_error['Level'] = 'Debug';
	} else if ($errno & E_STRICT) {
		$new_error['Level'] = 'Strict';
	} else {
		$new_error['Level'] = '(unknown)';
	}

	$_errors[] = $new_error;
}

function _getContextCode($file, $line)
{
	if (!@is_readable($file)) {
		return('');
	}

	$sourceLines = file($file);
	$offset = max($line - 1 - constant('CONTEXT_CODE_LINES'), 0);
	$numLines = 2 * constant('CONTEXT_CODE_LINES') + 1;

	$temp = array();
	for($a = $offset; $a < $offset+$numLines; $a++) {
		if(isset($sourceLines[$a])) {
			$temp[$a+1] = htmlentities(rtrim($sourceLines[$a]));
		}
	}

	return($temp);
}

function _getCleanedContext($variables)
{
	global $hidden_variables;
	
	if(!is_array($variables)) {
		return(array());
	}

	if (version_compare(phpversion(),'5.1.0RC1','>=')) {
		return(array_diff_key($variables, array_flip($hidden_variables)));
	} else {
		$new_vars = array();
	
		foreach($variables as $k => $v) {
			if(in_array($k, $hidden_variables)) {
				continue;
			}
	
			$new_vars[$k] = $v;
		}
	
		return($new_vars);
	}
}

function _getBackTrace()
{
	$backtrace = debug_backtrace();

	if (version_compare(phpversion(),'5.1.0','<')) {
		array_shift($backtrace);
		array_shift($backtrace);

		$temp = array();
		foreach($backtrace as $k => $bt) {
			$new_e = array(
				'File' => @$bt['file'],
				'Line' => @$bt['line'],
				);

			$args = array();
			if(isset($bt['args'])) {
				foreach($bt['args'] as $arg) {
					$args[] = _varExport($arg);
				}
			}
			$new_e['Function'] = (isset($bt['class'])?$bt['class']:'') .
				(isset($bt['type'])?$bt['type']:'') .
				$bt['function']=='unknown'?'':($bt['function'] . '(' . implode(', ', $args) . ')');

			$new_e['ContextCode'] = _getContextCode(@$bt['file'], @$bt['line']);

			$temp[] = $new_e;
		}
	} else {
		array_shift($backtrace);

		$next_context = '';
		$next_e = null;

		$temp = array();
		foreach($backtrace as $k => $bt) {

			$new_e = $next_e;

			if($new_e != null) {
				$args = array();
				if(isset($bt['args'])) {
					foreach($bt['args'] as $arg) {
						$args[] = _varExport($arg);
					}
				}
				$new_e['Function'] = (isset($bt['class'])?$bt['class']:'') .
					(isset($bt['type'])?$bt['type']:'') .
					$bt['function']=='unknown'?'':($bt['function'] . '(' . implode(', ', $args) . ')');

				$temp[] = $new_e;
			}

			$next_e = array(
				'File' => @$bt['file'],
				'Line' => @$bt['line'],
				'ContextCode' => _getContextCode(@$bt['file'], @$bt['line']),
				);
		}

		$next_e['Function'] = '';
		$temp[] = $next_e;
	}
	return($temp);
}

function _varExport($variable, $arrayIndent = '', $inArray = false, $level = 0)
{
	static $maxLevels = 100, $followObjectReferences = false;

	if($inArray) {
		$leadingSpace = '';
		$trailingSpace = ',' . "\n";
	} else {
		$leadingSpace = $arrayIndent;
		$trailingSpace = '';
	}

	$result = '';
	switch(gettype($variable)) {
	case 'object':
		if ($inArray && !$followObjectReferences) {
			$result = '*OBJECT REFERENCE*';
			$trailingSpace = "\n";
			break;
		}
	case 'array':
		if ($maxLevels && $level >= $maxLevels) {
			$result = '** truncated, too much recursion **';
		} else {
			$result = "\n" . $arrayIndent . 'array (' . "\n";
			foreach ($variable as $key => $value)
			{
				$result .= $arrayIndent . '  ' . (is_int($key) ? $key : ('\'' . str_replace('\'', '\\\'', $key) . '\'')) . ' => ' . _varExport($value, $arrayIndent . '  ', true, $level + 1);
			}

			$result .= $arrayIndent . ')';
		}
	break;
 
	case 'string':
		$result = '"' . $variable . '"';
		break;
 
	case 'boolean':
		$result = $variable ? 'true' : 'false';
		break;
 
	case 'NULL':
		$result = 'NULL';
		break;

	case 'resource':
		$result = get_resource_type($variable);
		break;

	default:
		$result = $variable;
		break;
	}

	return $leadingSpace . $result . $trailingSpace;
}

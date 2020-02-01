<?php
// This is needed for the Date Functions
//if(phpversion() > '5.0.1') { date_default_timezone_set('America/Los_Angeles'); }

require_once($BF. 'components/JSON.php');
$json = new Services_JSON();

// The configuration file that connects us to the mysql servers
include('ticketingsystem-conf.php');

// set up error reporting
require_once($BF. 'components/ErrorHandling/error_handler.php');
	

if(!isset($host)) {
	error_report("Include database conf failed");
	$connected = false;
} else {
	$connected = true;
	if($mysqli_connection = @mysqli_connect($host, $user, $pass)) {
		if(!@mysqli_select_db($mysqli_connection, $db)) {
			error_report("mysqli_select_db(): " . mysqli_error($mysqli_connection));
		}
	} else {
		error_report("mysqli_connect(): " . mysqli_connect_error($mysqli_connection));
	}
}
// clean up so that these variables aren't exposed through the debug console
unset($host, $user, $pass, $db);

// Set and use the session
session_name('ticketingsystem');
session_start();

// If Logout is set in the URL bar, destroy the session and cookies.
if(isset($_REQUEST['logout'])) {
	setcookie(session_name(), "", 0, "/");
	$_SESSION = array();
	session_unset();
	session_destroy();
	header("Location: ".$BF."index.php");
}

function maintenance_page() {
?>
	<h1>We're Sorry...</h1>
	<p>Could not connect to the database server.  We could be experiencing trouble, or the site may be down for maintenance.</p>
	<p>You can press the Refresh button to see if the site is available again.</p>
<?
	die();
}

function error_report($message) {
	ob_start();
	print_r(debug_backtrace());
	$trace = ob_get_contents();
	ob_end_clean();

	mail(constant('BUG_REPORT_ADDRESS'), '[ShowMan] Error',
		"- ERROR\n----------------\n" . $message . "\n\n\n- STACK\n----------------\n" . $trace
		);

	maintenance_page();		
}


function database_query($query, $description, $ignore_warnings=false, $connection=null) {

	global $mysqli_connection, $database_time;
	if($connection == null) {
		$connection = $mysqli_connection;
	}

	$begin_time = microtime(true);
	$result = mysqli_query($connection, $query);
	$end_time = microtime(true);

	$database_time += ($end_time-$begin_time);

	if(!is_bool($result)) {
		$num_rows = mysqli_num_rows($result);
		$str = $num_rows . " rows";
	} else {
		$affected = mysqli_affected_rows($connection);
		$str = $affected . " affected";
	}

	if ($result === false) {
		_error_debug(array('error' => mysqli_error($connection), 'query' => $query), "MySQL ERROR: " . $description, __LINE__, __FILE__, E_ERROR);
	} else {
		
		if(mysqli_warning_count($connection) && !$ignore_warnings) {
			$warnings = mysqli_get_warnings($connection);
			_error_debug(array('query' => $query, 'warnings' => $warnings), "MySQL WARNING(S): " . $description, __LINE__, __FILE__, E_WARNING);
		} else {
		
			_error_debug(array('query' => $query), "MySQL (" . $str . ", " . (round(($end_time-$begin_time)*1000)/1000) . " sec): " . $description, __LINE__, __FILE__);
		}
	}
	return($result);
}
// The only difference here is that in the return, it fetches the first associated row.  This is convenient for when you only want to pull back a
// single set of information.
function fetch_database_query($query, $description, $ignore_warnings=false, $connection=null) {

	global $mysqli_connection, $database_time;
	if($connection == null) {
		$connection = $mysqli_connection;
	}

	$begin_time = microtime(true);
	$result = mysqli_query($connection, $query);
	$end_time = microtime(true);

	$database_time += ($end_time-$begin_time);

	if(!is_bool($result)) {
		$num_rows = mysqli_num_rows($result);
		$str = $num_rows . " rows";
	} else {
		$affected = mysqli_affected_rows($connection);
		$str = $affected . " affected";
	}

	if ($result === false) {
		_error_debug(array('error' => mysqli_error($connection), 'query' => $query), "MySQL ERROR: " . $description, __LINE__, __FILE__, E_ERROR);
	} else {
		
	
		if(mysqli_warning_count($connection) && !$ignore_warnings) {
			$warnings = mysqli_get_warnings($connection);
			_error_debug(array('query' => $query, 'warnings' => $warnings), "MySQL WARNING(S): " . $description, __LINE__, __FILE__, E_WARNING);
		} else {
			_error_debug(array('query' => $query), "MySQL (" . $str . ", " . (round(($end_time-$begin_time)*1000)/1000) . " sec): " . $description, __LINE__, __FILE__);
		}
	}
	return(mysqli_fetch_assoc($result));
}

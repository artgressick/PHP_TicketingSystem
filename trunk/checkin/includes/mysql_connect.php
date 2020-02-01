<?php # Script 1.0 - mysql_connect.php
// Written by Arthur Gressick for use on Macintosh OS X.3
// this should work on any PHP/MySQL enabled server but you may
// have to tweak the settings. 

// Set the Database access information as contants. Remember
// This is assuming you have set-up a user and not Root

define ('DB_User', 'agressick'); //This is the Username that has been created.
define ('DB_Password', 'PASSWORD'); //This is the password for the User.
define ('DB_Host', '192.168.10.2'); //This is the Host Name of the WebServer.
define ('DB_Name', 'applespecialevents'); //This is the Database name in MySQL.

//Make the connection and then select the database.

$dbc = mysql_connect (DB_Host, DB_User, DB_Password) OR die ('Could not connect to MySQL Server: ' .
mysql_error() );
mysql_select_db (DB_Name) or die ('Could not select the database: ' . mysql_error() );
?>
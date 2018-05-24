<?php
$mysqlHost = "localhost";
$mysqlUser = "root";
$mysqlPass = "";

$mysqlDb = "hotel_management";
$mysqlError = "Failed to connect to database";

if(!mysql_connect($mysqlHost,$mysqlUser,$mysqlPass) || !mysql_select_db($mysqlDb)) {
	die($mysqlError);
}
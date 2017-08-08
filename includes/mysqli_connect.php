<?php

//$db = new mysqli('localhost', 'root', 'P@55w0rd', 'fitness');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($db->connect_error) {
	$error = $db->connect_error;
}

//sets the character set for current database operations
$db->set_charset('utf8');
?>


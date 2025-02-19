<?
	// data/db.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	$dbConfig = [
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dbName' => 'powerchord'
	];
	
	
	$db = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbName']);
?>
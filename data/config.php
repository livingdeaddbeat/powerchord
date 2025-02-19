<?
	// data/db.php
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}


	// Конфигурация настроек сайта
	$config = [
		'md5salt' => '___',
		'uploads' => MAINDIR.'\uploads\\',
		'uploads_gallery' => MAINDIR.'\uploads\gallery\\'
	];


?>

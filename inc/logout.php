<?
	// inc/deauthorization.php
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Выйти',
		'description' => '...',
		'keywords' => '...'
	];
	if(isLogged()){
		session_unset();
		session_destroy();
		relocationToMain();
	}else{
		relocationToMain();
	}
?>
<?
	// inc/about.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'О нас',
		'description' => '...',
		'keywords' => '...'
	];
	// Подключение файла шаблона модуля
	$content = getTemplate('about');
?>
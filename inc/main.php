<?
	// inc/main.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Продажа электрогитар, бас-гитар в Казахстане',
		'description' => '...',
		'keywords' => '...'
	];
	
	$items = itemsWrapHandler(getItems());

	$news = newsWrapHandler(getNews());
	// Подключение файла шаблона модуля
	$content = getTemplate('maincontent');
?>
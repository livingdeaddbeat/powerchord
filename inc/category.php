<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Категория',
		'description' => '...',
		'keywords' => '...'
	];
	
	$catId = (int) $_GET['id'];
	
	if($catId){
		$categoryInfo = getCategoryById($catId);
		
		if($categoryInfo){
			$metatags['title'] = 'Категория - '.$categoryInfo['name'];
			
			$items = itemsWrapHandler(getItems($catId));
		}else $data = returnError('Ошибка', 'Категории с таким идентификатором нет на сайте');
		
		
	}else{
		$data = returnError('Ошибка', 'Не указан идентификатор категории');
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('category');
?>
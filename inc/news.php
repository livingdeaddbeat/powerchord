<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Страница новости',
		'description' => '...',
		'keywords' => '...'
	];
	
	$newsId = (int) $_GET['id'];
	
	if($newsId){
		$newsInfo = getNewsById($newsId);
		
		if($newsInfo){
			$metatags['title'] = $newsInfo['title'];
			$galleryimages = '';
			
			if($newsInfo['galleryimages']){
				foreach(unserialize($newsInfo['galleryimages']) as $images){
					$galleryimages .= getTemplate('galleryimage', $images);
				}
			}
		}else{
			$data = returnError('Ошибка', 'Товара с таким идентификатором нет в базе данных');
		}
	}else{
		$data = returnError('Ошибка', 'Не указан идентификатор товара');
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('news');
?>
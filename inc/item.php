<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Странциа товара',
		'description' => '...',
		'keywords' => '...'
	];
	
	$itemId = (int) $_GET['id'];
	
	if($itemId){
		$itemInfo = getItemById($itemId);
		
		if($itemInfo){
			$metatags['title'] = $itemInfo['name'].' купить в Алматы';
			$galleryimages = '';
			
			if($itemInfo['galleryimages']){
				foreach(unserialize($itemInfo['galleryimages']) as $images){
					$galleryimages .= getTemplate('galleryimage', $images);
				}
			}
			
			// Работа с просмотрами товара
			$itemInfo['views']++;
			$SQL = "UPDATE `powerchord_items` SET views=".$itemInfo['views']." WHERE id=".$itemId;
			mysqli_query($db, $SQL);
		}else{
			$data = returnError('Ошибка', 'Товара с таким идентификатором нет в базе данных');
		}
	}else{
		$data = returnError('Ошибка', 'Не указан идентификатор товара');
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('item');
?>
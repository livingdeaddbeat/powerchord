<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Избранное',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged()){
		$itemId = (int) $_GET['itemId'];
		if($itemId){
			if(checkItemById($itemId)){
				$userId = getUserId();
				$addDate = time();
				
				$SQL = "INSERT INTO `powerchord_favorites` (userid, itemid, adddate) VALUES ({$userId}, {$itemId}, {$addDate})";
				
				if(mysqli_query($db, $SQL)){
					relocationToBack();
				}else $content = returnError('Ошибка', 'Не удалось добавить товар в корзину, ошибка базы данных.');
				
			}else $content = returnError('Ошибка', 'Товара с таким ID нет');
		}else $content = returnError('Ошибка', 'Не указан ID товара');
		
		// Подключение файла шаблона модуля
		$content = getTemplate('favoritesadditem');
	}else{
		$content = returnError('Ошибка', 'Добавление товаров в корзину доступно только авторизованным пользователям');
	}
	
	
	
?>
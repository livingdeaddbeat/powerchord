<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Удаление товаров из козины',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged()){
		$action = $_GET['action'];
		
		if($action == 'deleteitem'){
			$favItemId = (int) $_GET['itemId'];
			
			if(checkFavItemById($favItemId)){
				if(deleteFavItem($favItemId)) relocationToBack();
				else{
					$content = returnError('Ошибка', 'Не удалось удалить товары из корзины');
				}
			}else{
				$content = returnError('Ошибка', 'Не указан идентификатор товара либо в корзине нет такого товара');
			}
		}elseif($action == 'clearfav'){
			if($_GET['approve'] == 'true'){
				$count = clearUserFavorites();
				if($count){
					$content .= returnApprove('Действие выполнено', 'Все товары успешно удалены из корзины');
				}else{
					$content = returnError('Ошибка', 'Не удалось очистить корзину, попробуйте позже');
				}
			}else{
				$content .= <<<HTML
			<a class="btn btn-danger" href="/?do=deletefav&action=clearfav&approve=true" role="button"><i class="bi bi-bag-plus-fill"></i> Удалить все содержимое корзины</a> или <a class="btn btn-primary" href="/?do=cart" role="button"><i class="bi bi-bag-plus-fill"></i> вернуться назад</a>
HTML;
			}
		}else{
			$content = returnError('Ошибка', 'Не указан идентификатор действия');
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('deletefav');
	}else{
		$content = returnError('Ошибка', 'Добавление товаров в корзину доступно только авторизованным пользователям');
	}
	
	
	
?>
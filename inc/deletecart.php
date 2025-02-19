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
			$cartItemId = (int) $_GET['itemId'];
			
			if(checkCartItemById($cartItemId)){
				if(deleteCartItem($cartItemId)) relocationToBack();
				else{
					$content = returnError('Ошибка', 'Не удалось удалить товары из корзины');
				}
			}else{
				$content = returnError('Ошибка', 'Не указан идентификатор товара либо в корзине нет такого товара');
			}
		}elseif($action == 'clearbasket'){
			if($_GET['approve'] == 'true'){
				$count = clearUserBasket();
				if($count){
					$content .= returnApprove('Действие выполнено', 'Все товары успешно удалены из корзины');
				}else{
					$content = returnError('Ошибка', 'Не удалось очистить корзину, попробуйте позже');
				}
			}else{
				$content .= <<<HTML
			<a class="btn btn-danger" href="/?do=deletecart&action=clearbasket&approve=true" role="button">Удалить все содержимое корзины</a> или <a class="btn button-back-error" href="/?do=cart" role="button">Назад</a>
HTML;
			}
		}else{
			$content = returnError('Ошибка', 'Не указан идентификатор действия');
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('deletecart');
	}else{
		$content = returnError('Ошибка', 'Добавление товаров в корзину доступно только авторизованным пользователям');
	}
	
	
	
?>
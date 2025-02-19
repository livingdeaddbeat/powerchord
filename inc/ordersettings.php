<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Работа с статусом заказа',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged() and isAdmin()){
		$action = $_GET['action'];
		
		if($action == 'changestatus'){
			$action = 'Смена статуса товара';
			$orderId = (int) $_POST['orderId'];
			
			if(checkOrderById($orderId)){
				$selectStatus = (int) $_POST['selectstatus'];
				$SQL = "UPDATE `powerchord_orders` SET orderstatus={$selectStatus} WHERE id={$orderId}";
				
				if(mysqli_query($db, $SQL)){
					relocationToBack();
				}else{
					$content = returnError('Ошибка', 'Не удалось сменить статус заказа, попробуте позже');
				}
			}else{
				$content = returnError('Ошибка', 'Не указан идентификатор заказа либо в корзине нет такого заказа в базе данных');
			}
		}elseif($action == 'deleteorder'){
			$action = 'Удаление заказа';
			$orderId = (int) $_GET['orderId'];
			
			if($_GET['approve'] == 'true'){
				if(deleteOrderById($orderId)) relocationTo('/?do=neworders');
				else{
					$content = returnError('Ошибка', 'Не удалось удалить заказа, попробуйте позже');
				}
			}else{
				$content .= <<<HTML
			<div class="container">
			<a class="btn btn-danger mt-3" href="/?do=ordersettings&action=deleteorder&approve=true&orderId={$orderId}" role="button">Удалить заказ</a>
			</div>
HTML;
			}
		}else{
			$content = returnError('Ошибка', 'Не указан идентификатор действия');
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('orderchange');
	}else{
		$content = returnError('Ошибка', 'Добавление товаров в корзину доступно только авторизованным пользователям');
	}
	
	
	
?>
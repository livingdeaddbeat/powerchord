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
	
	$orderId = (int) $_GET['id'];
	
	if($orderId){
		$orderInfo = getOrderById($orderId);
		if($orderInfo){
			if(isAdmin() or $orderInfo['userid'] == getUserId()){
				$total = $orderInfo['ordertotal'];
				$orderDate = timestampToString($orderInfo['orderdate']);
				$orderItemsCount = count(unserialize($orderInfo['selectitems']));
				$orderItems = unserialize($orderInfo['selectitems']);
				$itemsList = '';
				
				foreach($orderItems as &$item){
					$itemData = getShortItemById($item);
					$itemsList .= <<<HTML
					<li class="list-group-item"><a href="/?do=item&id={$itemData['id']}">{$itemData['name']}</a></li>
HTML;
				}
				
				unset($item);
				
				$orderCustomer = getUserInfoById($orderInfo['userid']);
			}
		}else{
			$data = returnError('Ошибка', 'Заказа с таким идентификатором нет в базе данных');
		}
	}else{
		$data = returnError('Ошибка', 'Не указан идентификатор заказа');
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('order');
?>
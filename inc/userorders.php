<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Ваши заказы на сайте',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged()){
		$userOrders = getAllUserOrders();
		$orderCount = count($userOrders);
		$total = 0;
		
		if($userOrders){
			foreach($userOrders as $order){
				$total = $total + $order['ordertotal'];
				
				$orderDate = timestampToString($order['orderdate']);
				$orderItemsCount = count(unserialize($order['selectitems']));
				$orderStatus = getOrderStatus($order['orderstatus']);
				$data .= <<<HTML
						<tr>
						  <td><a href="/?do=order&id={$order['id']}" target="">{$orderDate}</a></td>
						  <td>{$orderItemsCount}</td>
						  <td>{$order['ordertotal']}</td>
						  <td>{$orderStatus}</td>
						</tr>
HTML;
			
			}
		}else{
			$data = '<tr><td>Нет заказов</td><td></td><td></td><td></td></tr>';
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('userorders');
	}else{
		$content = returnError('Ошибка доступа', 'Для работы с корзиной товаров необходимо пройти авторизацию.');
	}
	
	
	
?>
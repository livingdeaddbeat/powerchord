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
	
	if(isLogged() and isAdmin()){
		$newOrders = getAllOrders();
		$orderCount = count($newOrders);
		$total = 0;
		
		if($newOrders){
			foreach($newOrders as $order){
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
						  <td><a href="/?do=ordersettings&action=deleteorder&orderId={$order['id']}"><i class="bi bi-trash-fill text-danger"></i></a></td>
						</tr>
HTML;
			
			}
		}else{
			$data = '<tr><td>Нет заказов</td><td></td><td></td><td></td><td></td></tr>';
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('neworders');
	}else{
		$content = returnError('Ошибка доступа', 'Для работы с корзиной товаров необходимо пройти авторизацию.');
	}
	
	
	
?>
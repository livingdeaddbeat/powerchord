<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Оформление заказа',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged()){
		$userCartData = getItemInUserCart();
		$cartCount = count($userCartData);
		$itemsList = [];
		$orderDate = time();
		
		$total = 0;
		
		if($userCartData){
			foreach($userCartData as &$cartItem){
				$cartItem['itemdata'] = getShortItemById($cartItem['itemid']);
				$itemsList[] = $cartItem['itemid'];
			}
			
			unset($cartItem);
			
			foreach($userCartData as $cartItem){
				$total = $total + $cartItem['itemdata']['cost'];
			}
			
			$itemsList = serialize($itemsList);
			
			$SQL = "INSERT INTO `powerchord_orders` (`userid`, `selectitems`, `orderdate`, `ordertotal`) VALUES (".getUserId().", '{$itemsList}', {$orderDate}, {$total})";
			
			if(mysqli_query($db, $SQL)){
				clearUserBasket();
				$content = returnApprove('Поздравляем', 'Заказ оформлен, в ближайшее время с Вами свяжется наш специалист для уточнения деталей заказа.');
			}else{
				$content = returnError('Ошибка', 'Не удалось оформить заказа, попробуйте позже.');
			}
		}else{
			$content = returnError('Ошибка', 'Нет товаров в корзине');
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('setorder');
	}else{
		$content = returnError('Ошибка доступа', 'Для работы с корзиной товаров необходимо пройти авторизацию.');
	}
	
	
	
?>
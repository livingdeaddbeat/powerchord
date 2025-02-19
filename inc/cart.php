<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Корзина товаров',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isLogged()){
		$userCartData = getItemInUserCart();
		$cartCount = count($userCartData);
		
		$total = 0;
		
		if($userCartData){
			foreach($userCartData as &$cartItem){
				$cartItem['itemdata'] = getShortItemById($cartItem['itemid']);
			}
			
			unset($cartItem);
			
			foreach($userCartData as $cartItem){
				$total = $total + $cartItem['itemdata']['cost'];
				// $addDate = timestampToString($cartItem['adddate']);
				$data .= <<<HTML
		<tr>
		  <td><a href="/?do=item&id={$cartItem['itemdata']['id']}" target="_Blank">{$cartItem['itemdata']['name']}</a></td>
		  <td>{$cartItem['itemdata']['cost']}</td>
		  <!-- <td>{$addDate}</td> -->
		  <td><a href="/?do=deletecart&action=deleteitem&itemId={$cartItem['id']}">Удалить</a></td>
		</tr>
HTML;
	}}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('cart');
	}else{
		$content = '<div class="container">';
		$content .= returnError('Ошибка доступа', 'Для работы с корзиной товаров необходимо пройти авторизацию.');
		$content .= '</div>';
	}
	
	
	
?>
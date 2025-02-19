<?
	// inc/init.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Роутинг
	$module = $_GET['do'];
	
	if($db){
		if($module == 'item'){
			$file = 'item';
		}elseif($module == 'guitars'){
			$file = 'guitars';
		}elseif($module == 'ordersettings'){
			$file = 'ordersettings';
		}elseif($module == 'neworders'){
			$file = 'neworders';
		}elseif($module == 'order'){
			$file = 'order';
		}elseif($module == 'userorders'){
			$file = 'userorders';
		}elseif($module == 'setorder'){
			$file = 'setorder';
		}elseif($module == 'news'){
			$file = 'news';
		}elseif($module == 'deletecart'){
			$file = 'deletecart';
		}elseif($module == 'deletefav'){
			$file = 'deletefav';
		}elseif($module == 'favorites'){
			$file = 'favorites';
		}elseif($module == 'favoritesadditem'){
			$file = 'favoritesadditem';
		}elseif($module == 'cartadditem'){
			$file = 'cartadditem';
		}elseif($module == 'cart'){
			$file = 'cart';
		}elseif($module == 'cat'){
			$file = 'category';
		}elseif($module == 'registration'){
			$file = 'registration';
		}elseif($module == 'login'){
			$file = 'login';
		}elseif($module == 'logout'){
			$file = 'logout';
		}elseif($module == 'addnews'){
			$file = 'addnews';
		}elseif($module == 'userslist'){
			$file = 'userslist';
		}elseif($module == 'edituser'){
			$file = 'editUser';
		}elseif($module == 'deleteuser'){
			$file = 'deleteUser';
		}elseif($module == 'catlist'){
			$file = 'catlist';
		}elseif($module == 'addcat'){
			$file = 'addcat';
		}elseif($module == 'editcat'){
			$file = 'editcat';
		}elseif($module == 'deletecat'){
			$file = 'deletecat';
		}elseif($module == 'itemlist'){
			$file = 'itemlist';
		}elseif($module == 'additem'){
			$file = 'additem';
		}elseif($module == 'about'){
			$file = 'about';
		}else{
			if(empty($module)) $file = 'main';
			else{
				$errHeader = 'Ошибка';
				$errMsg = 'Такой страницы нет на сайте';
				$errColor = 'danger';
				$erorrStatus = 404;
				$file = 'error';
			}
		}
	}else{
		$errHeader = 'Ошибка базы данных';
		$errMsg = 'Ошибка базы данных ';
		$errColor = 'danger';
		$erorrStatus = false;
		$file = 'error';
	}
	
	// Подключение выбранного модуля
	include 'inc/'.$file.'.php';
	
	// Определение мета инфомрации
	if($metatags){
		$title = $metatags['title'];
		$description = $metatags['description'];
		$keywords = $metatags['keywords'];
	}else{
		$title = 'Заголовок страницы не прописан в файле модуля';
		$description = 'error';
		$keywords = 'error';
	}

	// Подсчет товаров в корзине
	$cartCount = 0;
	if(isLogged()) $cartCount = countItemInUserCart();

	// Подключение основного файла шаблона
	include 'temp/main.php';
	
?>
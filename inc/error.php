<?
	// inc/main.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Ошибка',
		'description' => '...',
		'keywords' => '...'
	];
	
	// Обработка headers
	if($erorrStatus == 404){
		header('HTTP/1.0 404 Not Found');
	}
	
	// Логирование bad HTTP статусов
	if($erorrStatus){
		$errorAthor = ', NONE AUTHOR';
		if(isLogged()){
			$errorAthor = ', ID: '.$userInfo['id'].', Email: '.$userInfo['email'];
		}
		$httperror = "[".date("l jS \of F Y h:i:s A").", ".$_SERVER['REQUEST_URI'].$errorAthor.", STATUS: ".$erorrStatus."]\n";
		file_put_contents('logs/httperrorlog.txt', $httperror, FILE_APPEND);
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('error');
	
?>
<?
	// inc/authorization.php
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Авторизация на сайте',
		'description' => '...',
		'keywords' => '...'
	];
	// Проверка на авторизацию
	if(isLogged()) relocationToMain();
	if(isPOST()){
		$email = varFilter($_POST['email']);
		$password = varFilter($_POST['password']);
		// Проверка валидности
		$errors = '';
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors .= '<li>Не валидный Email адрес!</li>';
			$emailError = true;
		}
		if(mb_strlen($password) < 4) $errors .= '<li>Пароль слишком маленький. Должен быть не менее 4 символов.</li>';
		if(empty($errors)){
			// Подготовка хэша
			$password = generateMD5($password);
			$data = $password;
			// Поиск пользователя в базе данных
			$selectUser = "SELECT `id` FROM `powerchord_users` WHERE email = '{$email}' AND password = '{$password}'";
			
			$result = mysqli_query($db, $selectUser);
			if(mysqli_num_rows($result) == 1){
				$_SESSION['userId'] = mysqli_fetch_assoc($result)['id'];
				
				relocationToMain();
			}else{
				$data = <<<HTML
				<ul>
					<li>Неправильный логин или пароль. Попробуйте еще раз или <a href="/?do=restorepassword">восстановите пароль</a>.</li>
				</ul>
				<br/>
				<br/>
				<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
HTML;
			}
		}else{
			$data = <<<HTML
			<ul>
				{$errors}
			</ul>
			<br/>
			<br/>
			<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
HTML;
		}
	}else{
		$data = getTemplate('loginForm');
	}
	
	// Подключение файла шаблона модуля
	$content = getTemplate('login');

	
?>
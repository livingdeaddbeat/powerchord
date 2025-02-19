<?
	// inc/registration.php
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Регистрация',
		'description' => '...',
		'keywords' => '...'
	];
	// Проверка на авторизацию
	if(isLogged()) relocationToMain();
	if(isPOST()){
		// Фильтрацию 
		$email = varFilter($_POST['email']);
		$password1 = varFilter($_POST['password1']);
		$password2 = varFilter($_POST['password2']);
		// Проверка валидности
		$errors = '';
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors .= '<li>Не валидный Email адрес!</li>';
			$emailError = true;
		}
		if(mb_strlen($password1) < 4) $errors .= '<li>Пароль слишком маленький. Должен быть не менее 4 символов.</li>';
		if($password1 != $password2) $errors .= '<li>Пароли не совпадают</li>';
		
		// Проверка уникальности email адреса
		if(empty($emailError)){
			$uniq_email = "SELECT * FROM `powerchord_users` WHERE email = '{$email}'";
			$resultUniqEmail = mysqli_query($db, $uniq_email);
			if(mysqli_num_rows($resultUniqEmail) > 0){
				$errors = '<li>Указанный Вами email адрес уже зарегистрирован на нашем сайте</li>'.$errors;
			}
		}
		if(empty($errors)){
			$regDate = time();
			$password = generateMD5($password1);
			$SQL = "INSERT INTO `powerchord_users` 
			(
				`email`, 
				`password`, 
				`regdate`
			)
			VALUES 
			(
				'{$email}', 
				'{$password}', 
				'{$regDate}'
			)";
			// Встраивание данных нового пользователя в базу данных
			if(mysqli_query($db, $SQL)){
				$data = getTemplate('approveReg');
			}else{
				$data = getTemplate('declainReg');;
			}
			
		}else{
			$data = <<<HTML
			<ul>
				{$errors}
			</ul>
			<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
HTML;
		}
	}else{
		$data = getTemplate('regForm');
	}
	// Подключение файла шаблона модуля
	$content = getTemplate('registration');
?>
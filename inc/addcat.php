<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Добавление категории',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		if(isPOST()){
			// Фильтрацию 
			$name = varFilter($_POST['name']);
			
			// Проверка валидности
			$errors = '';
			
			if(mb_strlen($name) < 1) $errors .= '<li>Имя категории слишком короткое. Должен быть не менее 4 символов.</li>';
			if(mb_strlen($name) > 32) $errors .= '<li>Имя категории слишком длинное. Должено быть не длиннее 32 символов.</li>';
			
			if(empty($errors)){
				$addDate = time();
				$addAuthor = $userInfo['id'];
				
				$SQL = "INSERT INTO `powerchord_category` 
				(
					`name`, 
					`addDate`,
					`addAuthor`
				)
				VALUES 
				(
					'{$name}', 
					'{$addDate}',
					'{$addAuthor}'
				)";
				
				// Встраивание данных
				if(mysqli_query($db, $SQL)){
					$data = <<<HTML
					<div class="d-flex flex-column">
						Категория была добавлена
						<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
					</div>
					
HTML;
				}else{
					$data = 'Не удалось создать категорию. Попробуйте позже.';
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
			$data = getTemplate('addCatForm');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	// Подключение файла шаблона модуля
	$content = getTemplate('addCat');
?>
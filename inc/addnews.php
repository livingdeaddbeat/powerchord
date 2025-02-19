<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Добавление новости',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		if(isPOST()){
			// dump($_POST);
			// Фильтрацию 
			$newsTitle = varFilter($_POST['title']);
			$newsDescription = varFilter($_POST['description']);
			
			// Проверка валидности
			$errors = '';
			
			if(mb_strlen($newsTitle) < 4) $errors .= '<li>Слишком краткое наименование товара</li>';
			if(mb_strlen($newsTitle) > 86) $errors .= '<li>Слишком длинное наименование товара</li>';
			
			if(mb_strlen($newsDescription) < 32) $errors .= '<li>Слишком краткое наименование товара. Описание товара должно иметь хотя бы 32 символа</li>';
			
			if(!$_FILES['newsImage']['name']) $errors .= '<li>Не указано главное изображение товара</li>';
			
			$imgType = $_FILES['newsImage']['type'];
			
			if(!($imgType == 'image/jpeg' or $imgType == 'image/png')){
				$errors .= '<li>Тип загружеаемого изображения не соответствует разрешенным типам: png или jpg </li>';
			}
			
			if($_FILES['newsImage']['size'] > (1000000 * 32)) $errors .= '<li>Размер загружаемого файла не может быть больше 32 мегабайт</li>';
			
			if($_FILES['newsImage']['error'] != UPLOAD_ERR_OK) $errors .= '<li>Неизвестная ошибка загрузки изображения на сервер, обратитесь к разработчику</li>';
			
			
			if(empty($errors)){
				// Загрузка главного изображения на сервер
				$uploadfilename = time().'_'.trim(basename($_FILES['newsImage']['name']));
				$temp_upload_file = $config['uploads'].$uploadfilename;
				
				if(!move_uploaded_file($_FILES['newsImage']['tmp_name'], $temp_upload_file))$errors .= '<li>Не удалось загрузить файл на сервер</li>';
				
			
				$addDate = time();
				
				$SQL = "INSERT INTO powerchord_news(image, title, description, addDate) VALUES ('{$uploadfilename}','{$newsTitle}','{$newsDescription}','{$addDate}')";
				
				// Встраивание данных
				if(mysqli_query($db, $SQL)){
					$data = 'Товар была добавлен';
				}else{
					$data = 'Не удалось добавить. Попробуйте позже.';
				}
			}else{
				$data = <<<HTML
				<ul>
					{$errors}
				</ul>
				<br/>
				<br/>
				<button type="button" class="btn btn-warning" onclick="history.back(-1)">Назад</button>
HTML;
			}
			
		}else{
			$data = getTemplate('addNewsForm');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	// Подключение файла шаблона модуля
	$content = getTemplate('addNews');
?> 
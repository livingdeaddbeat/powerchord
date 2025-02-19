<?
	// inc/registration.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Добавление нового товара',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		if(isPOST()){
			// Фильтрацию 
			$itemCatId = (int) $_POST['itemCategory'];
			$itemName = varFilter($_POST['itemName']);
			$itemBrand = (int) $_POST['itemBrand'];
			$itemCost = (int) $_POST['itemCost'];
			$itemCount = (int) $_POST['itemCount'];
			$itemStringNum = (int) $_POST['itemStringNum'];
			$itemDescription = varFilter($_POST['itemDescription']);
			$itemPickups = varFilter($_POST['itemPickups']);
			
			// Проверка валидности
			$errors = '';
			
			if(mb_strlen($itemName) < 4) $errors .= '<li>Слишком краткое наименование товара</li>';
			if(mb_strlen($itemName) > 64) $errors .= '<li>Слишком длинное наименование товара</li>';
			if($itemCatId == 0) $errors .= '<li>Не указана категория товара</li>';
			if(empty($itemBrand)) $errors .= '<li>Не указан бренд товара</li>';
			if($itemCost == 0) $errors .= '<li>Неправильная цена товара</li>';
			if(mb_strlen($itemDescription) < 32) $errors .= '<li>Слишком краткое наименование товара. Описание товара должно иметь хотя бы 32 символа</li>';
			if(mb_strlen($itemPickups) < 0) $errors .= '<li>Не указана информация о звукоснимателях</li>';
			
			if(!$_FILES['itemImages']['name']) $errors .= '<li>Не указано главное изображение товара</li>';
			
			$imgType = $_FILES['itemImages']['type'];
			
			if(!($imgType == 'image/jpeg' or $imgType == 'image/png')){
				$errors .= '<li>Тип загружеаемого изображения не соответствует разрешенным типам: png или jpg </li>';
			}
			
			if($_FILES['itemImages']['size'] > (1000000 * 32)) $errors .= '<li>Размер загружаемого файла не может быть больше 32 мегабайт</li>';
			
			if($_FILES['itemImages']['error'] != UPLOAD_ERR_OK) $errors .= '<li>Неизвестная ошибка загрузки изображения на сервер, обратитесь к разработчику</li>';
			
			// Проверка галереи изображений
			foreach($_FILES["galleryImagesItem"]["error"] as $error) {
				if($error == UPLOAD_ERR_NO_FILE) continue;
				if(!$error == UPLOAD_ERR_OK) $errors .= '<li style="color:red;">Одно из изображений галереи не загрузилось, попробуйте еще раз</li>';
				
			}
			
			
			if(empty($errors)){
				// Загрузка главного изображения на сервер
				$uploadfilename = time().'_'.trim(basename($_FILES['itemImages']['name']));
				$temp_upload_file = $config['uploads'].$uploadfilename;
				
				if(!move_uploaded_file($_FILES['itemImages']['tmp_name'], $temp_upload_file))$errors .= '<li>Не удалось загрузить файл на сервер</li>';
				
				// Загруза галареи изображений на сервер
				$galleryImages = [];
				
				foreach ($_FILES["galleryImagesItem"]["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["galleryImagesItem"]["tmp_name"][$key];
						
						$load_file_name = time().'_'.trim(basename($_FILES["galleryImagesItem"]["name"][$key]));
						
						$temp_load_file = $config['uploads_gallery'].$load_file_name;
						
						if(move_uploaded_file($tmp_name, $temp_load_file)){
							$galleryImages[] = $load_file_name;
						}
					}
				}
				
				$galleryImages = serialize($galleryImages);
			
				$addDate = time();
				$addAuthor = $userInfo['id'];
				
				$SQL = "INSERT INTO `powerchord_items` 
				(
					`catid`,
					`name`,
					`itemBrand`,
					`cost`,
					`count`,
					`itemStringNum`,
					`itemPickups`,
					`images`,
					`galleryimages`,
					`description`,
					`adddate`,
					`addauthor`
				)
				VALUES 
				(
					'{$itemCatId}',
					'{$itemName}',
					'{$itemBrand}',
					'{$itemCost}',
					'{$itemCount}',
					'{$itemStringNum}',
					'{$itemPickups}',
					'{$uploadfilename}',
					'{$galleryImages}',
					'{$itemDescription}',
					'{$addDate}',
					'{$addAuthor}'
				)";
				
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
				<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
HTML;
			}
			
		}else{
			$data = getTemplate('addItemForm');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	// Подключение файла шаблона модуля
	$content = getTemplate('addItem');
?>
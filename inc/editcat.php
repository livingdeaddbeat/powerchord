<?
	// inc/editcat.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Редактирование категории',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		$catId = (int) $_GET['catId'];
		
		if($catId){
			// Получение информации о категории
			$SQL = "SELECT * FROM `powerchord_category` WHERE id={$catId}";
			
			$result = mysqli_query($db, $SQL);
			
			if(mysqli_num_rows($result)){
				$categoryInfo = mysqli_fetch_assoc($result);
				
				if(isPOST()){
					// Фильтрацию 
					$name = varFilter($_POST['name']);
					
					
					// Проверка валидности данных
					if(mb_strlen($name) < 4) $errors .= '<li>Имя категории слишком короткое. Должен быть не менее 4 символов.</li>';
					if(mb_strlen($name) > 32) $errors .= '<li>Имя категории слишком длинное. Должено быть не длиннее 32 символов.</li>';
					
					if(empty($errors)){
						$UPDSQL = "UPDATE `powerchord_category` SET `name`='{$name}' WHERE id={$catId}";
						
						$result = mysqli_query($db, $UPDSQL);
						if(mysqli_affected_rows($db)){
							$info = 'Изменения успешно внесены';
						}else{
							$info = 'Операция прошла успешно, но никаких изменения внесено небыло.';
						}
					}else{
						$info = <<<HTML
						<ul>
							{$errors}
						</ul>
						<br/>
						<br/>
						<button type="button" class="btn button-back-error" onclick="history.back(-1)">Назад</button>
HTML;
					}
					
				}else{
					$info = getTemplate('editCatForm');
				}
			}else{
				$info = returnError('Ошибка', 'Категории с таким идентификатором не существует');
			}
			
			
			// Подключение файла шаблона модуля
			$content = getTemplate('editcat');
		}else{
			$content = returnError('Ошибка', 'Неправильный идентификатор категории');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
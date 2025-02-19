<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Редактирование пользователя',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		$userId = (int) $_GET['userId'];
		
		if($userId){
			// Получение списка всех пользователей
			$SQL = "SELECT * FROM `powerchord_users` WHERE id={$userId}";
			
			$result = mysqli_query($db, $SQL);
			
			if(mysqli_num_rows($result)){
				$userData = mysqli_fetch_assoc($result);
				
				if(isPOST()){
					// Фильтрацию 
					$email = varFilter($_POST['email']);
					$userstatus = (int) $_POST['userstatus'];
					
					
					// Проверка валидности данных
					if(empty($userstatus)) $errors .= '<li>Не указан тип аккаунта</li>';
					
					if(empty($errors)){
						$UPDSQL = "UPDATE `powerchord_users` SET `userstatus`={$userstatus} WHERE id={$userId}";
						
						$result = mysqli_query($db, $UPDSQL);
						if(mysqli_affected_rows($db)){
							$info = 'Изменения успешно внесены';
						}else{
							$info = 'Операция прошла успешно, но никаких изменения внесено не было.';
						}
					}else{
						$info = <<<HTML
						<ul>
							{$errors}
						</ul>
						<br/>
						<br/>
						<button type="button" class="btn button-error-back" onclick="history.back(-1)">Назад</button>
HTML;
					}
					
				}else{
					$info = getTemplate('edituserForm');
				}
			}else{
				$info = returnError('Ошибка', 'Пользователь с таким идентификатором не существует');
			}
			
			
			// Подключение файла шаблона модуля
			$content = getTemplate('editUser');
		}else{
			$content = returnError('Ошибка', 'Неправильный идентификатор пользователя');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
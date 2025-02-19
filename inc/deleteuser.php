<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Удаление пользователя',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		$userId = (int) $_GET['userId'];
		
		if($userId and $userId > 1 and $userId != $userInfo['id']){
			// Получение списка всех пользователей
			$SQL = "SELECT id, email FROM `powerchord_users` WHERE id={$userId}";
			
			$result = mysqli_query($db, $SQL);
			
			if(mysqli_num_rows($result)){
				$deleteUserInfo = mysqli_fetch_assoc($result);
				if($_GET['delete'] == 'true'){
					$SQL = 'DELETE FROM `powerchord_users` WHERE `id` = '.$deleteUserInfo['id'];
					
					if(mysqli_query($db, $SQL)){
						$info = returnApprove('Успешное действие', 'Пользователь '.$deleteUserInfo['email'].' удален');
					}else{
						$info = returnError('Ошибка', 'Не удалось произвести операцию удаления пользователя. Обратитесь к адмнистратору сайта.');
					}
				}else{
					$info = 'Необходимо подтвердить действие:<br/><a href="'.$_SERVER['REQUEST_URI'].'&delete=true" class="btn btn-danger mt-3">Удалить '.$deleteUserInfo['email'].'</a>';
				}
			}else{
				$info = returnError('Ошибка', 'Пользователь с таким идентификатором не существует');
			}
			
			// Подключение файла шаблона модуля
			$content = getTemplate('deleteuser');
		}else{
			if($userId == 1) $content = returnError('Ошибка', 'Нельзя удалять главного администратора сайта');
			else $content = returnError('Ошибка', 'Неправильный идентификатор пользователя');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
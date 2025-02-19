<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Удаление категории',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		$catId = (int) $_GET['catId'];
		
		if($catId){
			// Получение списка всех пользователей
			$SQL = "SELECT id, name FROM `powerchord_category` WHERE id={$catId}";
			
			$result = mysqli_query($db, $SQL);
			
			if(mysqli_num_rows($result)){
				$deleteCatInfo = mysqli_fetch_assoc($result);
				if($_GET['delete'] == 'true'){
					$SQL = 'DELETE FROM `powerchord_category` WHERE `id` = '.$deleteCatInfo['id'];
					
					if(mysqli_query($db, $SQL)){
						$info = returnApprove('Успешное действие', 'Категория '.$deleteCatInfo['name'].' удалена');
					}else{
						$info = returnError('Ошибка', 'Не удалось произвести операцию удаления категории. Обратитесь к адмнистратору сайта.');
					}
				}else{
					$info = 'Необходимо подтвердить действие:<br/><a href="'.$_SERVER['REQUEST_URI'].'&delete=true" class="btn btn-danger mt-3">Удалить "'.$deleteCatInfo['name'].'" (ID: '.$deleteCatInfo['id'].')</a>';
				}
			}else{
				$info = returnError('Ошибка', 'Категории с таким идентификатором не существует');
			}
			
			// Подключение файла шаблона модуля
			$content = getTemplate('deletecat');
		}else{
			$content = returnError('Ошибка', 'Неправильный идентификатор категории');
		}
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
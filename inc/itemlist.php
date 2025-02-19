<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Список всех товаров сайта',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		// Получение списка всех пользователей
		$SQL = 'SELECT `id`, `email`, `regdate`, `userstatus` FROM `powerchord_users`';
		
		$result = mysqli_query($db, $SQL);
		$userCount = mysqli_num_rows($result);
		if($userCount){
			$allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			foreach($allUsers as $user){
				$user['regdate'] = timestampToString($user['regdate']);
				$user['userstatus'] = getUserStatus($user['userstatus']);
				$data .= <<<HTML
		<tr>
		  <th scope="row">{$user['id']}</th>
		  <td>{$user['email']}</td>
		  <td>{$user['regdate']}</td>
		  <td>{$user['regdate']}</td>
		  <td>{$user['userstatus']}</td>
		  <td><center><a href="/?do=edituser&userId={$user['id']}"><i class="bi bi-gear-fill text-warning"></i></a> <a href="/?do=deleteuser&userId={$user['id']}"><i class="bi bi-trash-fill text-danger"></i></a></center></td>
		</tr>
HTML;
			}
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('itemlist');
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
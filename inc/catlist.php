<?
	// inc/deauthorization.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	// Переопределение заголовков модуля
	$metatags = [
		'title' => 'Список всех категорий товаров на сайте',
		'description' => '...',
		'keywords' => '...'
	];
	
	if(isAdmin()){
		// Получение списка всех пользователей
		$SQL = 'SELECT * FROM `powerchord_category`';
		
		$result = mysqli_query($db, $SQL);
		$catsCount = mysqli_num_rows($result);
		if($catsCount){
			$allCats = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			foreach($allCats as $cat){
				$cat['addDate'] = timestampToString($cat['addDate']);
				$cat['addAuthor'] = getUserInfoById($cat['addAuthor'])['email'];
				$data .= <<<HTML
		<tr>
		  <th scope="row">{$cat['id']}</th>
		  <td>{$cat['name']}</td>
		  <td>{$cat['addDate']}</td>
		  <td>{$cat['addAuthor']}</td>
		  <td><a href="/?do=editcat&catId={$cat['id']}"><i class="bi bi-gear-fill text-white-50"></i></a> <a href="/?do=deletecat&catId={$cat['id']}"><i class="bi bi-trash-fill text-danger"></i></a></td>
		</tr>
HTML;
			}
		}
		
		// Подключение файла шаблона модуля
		$content = getTemplate('catlist');
	}else{
		$content = returnError('Ошибка доступа', 'У Вас недостаоочно прав для просмотра данного контента.');
	}
	
	
	
?>
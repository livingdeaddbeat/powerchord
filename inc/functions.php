<?
	// inc/functions.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	function dump($var){
		echo "<pre>";
			var_dump($var);
		echo "</pre>";
	}
	
	function getTemplate($filename, $tempData = []){
		ob_start();
		include 'temp/'.$filename.'.php';
		$r = ob_get_contents();
		ob_end_clean();
		
		return $r;
	}
	
	function getVar($name){
		return $GLOBALS[$name];
	}
	
	function isPOST(){
		if($_SERVER['REQUEST_METHOD'] == 'POST') return true;
	}
	
	function renderCities($selected = false){
		global $cities;
		$data = '';
		$selected = (int) $selected;

		if($cities){
			foreach($cities as $id=>$city){
				if($selected and $selected == $id) $data .= "<option value='{$id}' selected>".$city.'</option>';
				else $data .= "<option value='{$id}'>".$city.'</option>';
			}
		}
		
		return $data;
	}

	function renderUserStatus($selected = false){
		global $usersStatus;
		$data = '';
		$selected = (int) $selected;
		
		if($usersStatus){
			foreach($usersStatus as $id=>$status){
				if($selected and $selected == $id) $data .= "<option value='{$id}' selected>".$status.'</option>';
				else $data .= "<option value='{$id}'>".$status.'</option>';
				
			}
		}
		
		return $data;
	}
	function renderBrands($selected = false){
		global $brands;
		$data = '';
		$selected = (int) $selected;
		
		if($brands){
			foreach($brands as $id=>$brand){
				if($selected and $selected == $id) $data .= "<option value='{$id}' selected>".$brand.'</option>';
				else $data .= "<option value='{$id}'>".$brand.'</option>';
				
			}
		}
		
		return $data;
	}
	
	function varFilter($v){
		global $db;
		return mysqli_real_escape_string($db, $v);
	}

	function generateMD5($data){
		global $config;
		return md5(md5(md5($data.$config['md5salt'])));
	}

	function relocationToMain(){
		header('Location: /');
	}
	
	function relocationToBack(){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

	
	function relocationTo($to){
		header('Location: '.$to);
	}

	function isLogged(){
		return (bool) $_SESSION['userId'];
	}

	function getUserId(){
		return (int) $_SESSION['userId'];
	}

	function getUserEmail(){
		global $userInfo;
		return $userInfo['email'];
	}

	function getUserStatus($status){
		if($status == 1) return 'Администратор';
		elseif($status == 5) return 'Пользователь';
		else return 'Неизвестный статус';
	}

	function getBrand($brand){
		if($brand == 1) return 'Dean';
		elseif($brand == 2) return 'Solar';
		elseif($brand == 3) return 'Gibson';
		elseif($brand == 4) return 'Ibanez';
		elseif($brand == 5) return 'ESP';
		elseif($brand == 6) return 'Jackson';
		else return 'Неизвестный статус';
	}
	function getOrderStatus($orderStatus){
		if($orderStatus == 1) return 'В обработке';
		elseif($orderStatus == 2) return 'Ожидает оплаты';
		elseif($orderStatus == 3) return 'Оплачено, ожидается доставка';
		elseif($orderStatus == 4) return 'Оплачено, доставлено';
		else return 'Неизвестный статус';
	}

	function splitFio($fio){
		$result = explode(" ", $fio);
		return ['lastName' => $result[0], 'firstName' => $result[1], 'patron' => $result[2]];
	}	

	function isAdmin(){
		global $userInfo;
		if($userInfo['userstatus'] == 1) return true;
		else return false;
	}

	function returnError($errHeader, $errBody){
		return getTemplate('returnError', ['errHeader' => $errHeader, 'errBody' => $errBody]);
	}

	function returnApprove($apprHeader, $apprBody){
		return getTemplate('returnApprove', ['apprHeader' => $apprHeader, 'apprBody' => $apprBody]);
	}
	
	function timestampToString($timestamp){
		return date("d.m.Y", $timestamp);
	}

	function getUserInfoById($id){
		global $db;
		$id = (int) $id;
		
		if($id){
			
			$selectUser = "SELECT * FROM `powerchord_users` WHERE id = {$id}";
			$result = mysqli_query($db, $selectUser);
			if(mysqli_num_rows($result) == 1){
				return mysqli_fetch_assoc($result);
			}
		}
		
		return false;
	}

	
	function getAllCategory(){
		global $db;
		
		$sql = 'SELECT * FROM `powerchord_category`';
		
		$r = mysqli_query($db, $sql);
		if(mysqli_num_rows($r)){
			return mysqli_fetch_all($r, MYSQLI_ASSOC);
		}
		
		return [];
	}
	
	function renderCategory($selected = false){
		$category = getAllCategory();
		
		if($category){
			$data = '';
			$selected = (int) $selected;
			
			if($category){
				foreach($category as $cat){
					if($selected and $selected == $cat['id']) $data .= "<option value='{$cat['id']}' selected>".$cat['name'].'</option>';
					else $data .= "<option value='{$cat['id']}'>".$cat['name'].'</option>';
				}
			}
			
			return $data;
		}
		
		return "<option checked selected>В базе данных нет категорий</option>";
	}

	function renderCatMenu(){
		$category = getAllCategory();
		
		$menu = '';
		
		if($category){
			foreach($category as $cat){
				$menu .= "<li><a class='dropdown-item' href='/?do=guitars&catid={$cat['id']}'>{$cat['name']}</a></li>";
			}
		}
		
		return $menu;
	}
	
	function getCategoryById($catId){
		global $db;
		
		$catId = (int) $catId;
		
		if($catId){
			$sql = "SELECT * FROM `powerchord_category` WHERE id = {$catId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r);
			}
		}
		
		return [];
	}

	function getCategoryNameById($catId){
		global $db;
		
		$catId = (int) $catId;
		
		if($catId){
			$sql = "SELECT name FROM `powerchord_category` WHERE id = {$catId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r)['name'];
			}
		}
		
		return [];
	}
	
	function getItems($catId = false){
		global $db;
		$catId = (int) $catId;
		
		if($catId){
			// $sql = "SELECT * FROM `powerchord_items` WHERE catid = {$catId}";
			$sql = "SELECT * FROM `powerchord_items` WHERE catid = {$catId} LIMIT 5";
		}else $sql = "SELECT * FROM `powerchord_items` ORDER BY `id` DESC LIMIT 5";
		
		$r = mysqli_query($db, $sql);
		if(mysqli_num_rows($r)){
			return mysqli_fetch_all($r, MYSQLI_ASSOC);
		}
		
		return [];
	}
	
	function itemsWrapHandler($itemsData){
		$data = '';
		
		if($itemsData){
			foreach($itemsData as $item){
				$data .= getTemplate('itemCard', $item);
			}
		}else $data = 'Нет товаров';
		
		return $data;
	}

	function getNews($id = false){
		global $db;
		$sql = "SELECT * FROM `powerchord_news` ORDER BY id DESC LIMIT 4;";
		
		$r = mysqli_query($db, $sql);
		if(mysqli_num_rows($r)){
			return mysqli_fetch_all($r, MYSQLI_ASSOC);
		}
		
		return [];
	}
	
	function newsWrapHandler($itemsData){
		$data = '';
		
		if($itemsData){
			foreach($itemsData as $new){
				$data .= getTemplate('newsCard', $new);
			}
		}else $data = 'Нет товаров';
		
		return $data;
	}


	
	function getItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT * FROM `powerchord_items` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r);
			}
		}
		
		return [];
	}
	function getNewsById($newsId){
		global $db;
		
		$newsId = (int) $newsId;
		
		if($newsId){
			$sql = "SELECT * FROM `powerchord_news` WHERE id = {$newsId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r);
			}
		}
		
		return [];
	}

	function getShortItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT id, name, cost  FROM `powerchord_items` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r);
			}
		}
		
		return [];
	}
	
	function checkItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT id FROM `powerchord_items` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return true;
			}
		}
		
		return false;
	}
	
	function countItemInUserCart(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$sql = "SELECT COUNT(id) AS itemCount FROM `powerchord_cart` WHERE userid = {$userId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r)['itemCount'];
			}
		}
		
		return 0;
	}
	
	function getItemInUserCart(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$sql = "SELECT id, itemid, adddate FROM `powerchord_cart` WHERE userid = {$userId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_all($r, MYSQLI_ASSOC);
			}
		}
		
		return NULL;
	}
	
	function checkCartItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT id FROM `powerchord_cart` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return true;
			}
		}
		
		return false;
	}
	function checkFavItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT id FROM `powerchord_favorites` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return true;
			}
		}
		
		return false;
	}

	function countItemInUserFavorite(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$sql = "SELECT COUNT(id) AS itemCount FROM `powerchord_favorites` WHERE userid = {$userId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r)['itemCount'];
			}
		}
		
		return 0;
	}
	
	function getItemInUserFavorite(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$sql = "SELECT id, itemid, adddate FROM `powerchord_favorites` WHERE userid = {$userId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_all($r, MYSQLI_ASSOC);
			}
		}
		
		return NULL;
	}
	
	function checkFavoriteItemById($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$sql = "SELECT id FROM `powerchord_favorites` WHERE id = {$itemId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return true;
			}
		}
		
		return false;
	}
	
	function deleteCartItem($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$SQL = 'DELETE FROM `powerchord_cart` WHERE `id` = '.$itemId;
			
			$r = mysqli_query($db, $SQL);
			if(mysqli_affected_rows($db)){
				return true;
			}
		}
		
		return false;
	}
	
	
	function deleteFavItem($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$SQL = 'DELETE FROM `powerchord_favorites` WHERE `id` = '.$itemId;
			
			$r = mysqli_query($db, $SQL);
			if(mysqli_affected_rows($db)){
				return true;
			}
		}
		
		return false;
	}
	
	
	function deleteFavoriteItem($itemId){
		global $db;
		
		$itemId = (int) $itemId;
		
		if($itemId){
			$SQL = 'DELETE FROM `powerchord_favorites` WHERE `id` = '.$itemId;
			
			$r = mysqli_query($db, $SQL);
			if(mysqli_affected_rows($db)){
				return true;
			}
		}
		
		return false;
	}

	function clearUserBasket(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$SQL = 'DELETE FROM `powerchord_cart` WHERE `userid` = '.$userId;
			
			if(mysqli_query($db, $SQL)){
				return mysqli_affected_rows($db);
			}
		}
		
		return false;
	}

	function clearUserFavorites(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$SQL = 'DELETE FROM `powerchord_favorites` WHERE `userid` = '.$userId;
			
			if(mysqli_query($db, $SQL)){
				return mysqli_affected_rows($db);
			}
		}
		
		return false;
	}

	
	function getAllUserOrders(){
		global $db;
		
		$userId = (int) getUserId();
		
		if($userId){
			$sql = "SELECT * FROM `powerchord_orders` WHERE userid = {$userId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_all($r, MYSQLI_ASSOC);
			}
		}
		
		return NULL;
	}

	
	function getAllOrders(){
		global $db;
		
		$sql = "SELECT * FROM `powerchord_orders` ORDER BY `orderdate` DESC";
		
		$r = mysqli_query($db, $sql);
		if(mysqli_num_rows($r)){
			return mysqli_fetch_all($r, MYSQLI_ASSOC);
		}
		
		return NULL;
	}
	
	function getOrderById($orderId){
		global $db;
		
		$orderId = (int) $orderId;
		
		if($orderId){
			$sql = "SELECT * FROM `powerchord_orders` WHERE id = {$orderId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return mysqli_fetch_assoc($r);
			}
		}
		
		return [];
	}
	
	function renderOrderStatus($selected = false){
		global $orderStatus;
		$data = '';
		$selected = (int) $selected;
		
		if($orderStatus){
			foreach($orderStatus as $id=>$status){
				if($selected and $selected == $id) $data .= "<option value='{$id}' selected>".$status.'</option>';
				else $data .= "<option value='{$id}'>".$status.'</option>';
			}
		}
		
		return $data;
	}
	
	function checkOrderById($orderId){
		global $db;
		
		$orderId = (int) $orderId;
		
		if($orderId){
			$sql = "SELECT id FROM `powerchord_orders` WHERE id = {$orderId}";
			
			$r = mysqli_query($db, $sql);
			if(mysqli_num_rows($r)){
				return true;
			}
		}
		
		return false;
	}
	
	function deleteOrderById($orderId){
		global $db;
		
		$orderId = (int) $orderId;
		
		if($orderId){
			$SQL = 'DELETE FROM `powerchord_orders` WHERE `id` = '.$orderId;
			
			$r = mysqli_query($db, $SQL);
			if(mysqli_affected_rows($db)){
				return true;
			}
		}
		
		return false;
	}

	function getAllUserEmailsExceptAdmin() {
		global $db;
		$emails = [];
		$result = mysqli_query($db, "SELECT email FROM powerchord_users WHERE userstatus != '1'");
		while ($row = mysqli_fetch_assoc($result)) {
			$emails[] = $row['email'];
		}
		return $emails;
	}
	
	function paginate($db, $table, $fields, $conditions = '', $usersPerPage = 10) {
		// Step 1: Determine the total number of users
		$totalUsersQuery = "SELECT COUNT(*) as total FROM `$table` $conditions";
		$result = mysqli_query($db, $totalUsersQuery);
		$totalUsersArray = mysqli_fetch_assoc($result);
		$totalUsers = $totalUsersArray['total'];
	
		// Step 2: Calculate the number of pages
		$totalPages = ceil($totalUsers / $usersPerPage);
	
		// Step 3: Fetch users for the current page
		$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
	
		if ($currentPage > $totalPages) {
			$currentPage = $totalPages;
		}
	
		if ($currentPage < 1) {
			$currentPage = 1;
		}
	
		$offset = ($currentPage - 1) * $usersPerPage;
		$fieldsString = implode(", ", $fields);
		$query = "SELECT $fieldsString FROM `$table` $conditions LIMIT $offset, $usersPerPage";
		$result = mysqli_query($db, $query);
	
		$data = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
	
		return ['data' => $data, 'currentPage' => $currentPage, 'totalPages' => $totalPages];
	}
	

	function generatePaginationLinks($currentPage, $totalPages, $baseUrl) {
		$paginationLinks = '<nav><ul class="pagination">';
		if ($currentPage > 1) {
			$paginationLinks .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '&page=' . ($currentPage - 1) . '"><</a></li>';
		}
		for ($i = 1; $i <= $totalPages; $i++) {
			if ($i == $currentPage) {
				$paginationLinks .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
			} else {
				$paginationLinks .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '&page=' . $i . '">' . $i . '</a></li>';
			}
		}
		if ($currentPage < $totalPages) {
			$paginationLinks .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '&page=' . ($currentPage + 1) . '">></a></li>';
		}
		$paginationLinks .= '</ul></nav>';
	
		return $paginationLinks;
	}
	
?>
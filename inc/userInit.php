<?
	// inc/userInit.php
	
	// Protection
	if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	
	if(isLogged()){
		$selectUserInfoSQL = "SELECT * FROM `powerchord_users` WHERE id = ".getUserId();
		
		$result = mysqli_query($db, $selectUserInfoSQL);
		if(mysqli_num_rows($result)){
			$userInfo = mysqli_fetch_assoc($result);
			$userInfo['userStatusName'] = getUserStatus($userInfo['userstatus']);
			$userInfo['userFIO'] = splitFio($userInfo['fio']);
			$userInfo['userEmail'] = getUserEmail();

		}else{
			header('Location: /?do=logout');
		}
		
		unset($result);
	}
	
?>
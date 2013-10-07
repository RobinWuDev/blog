<?php
/**
 * 管理模型
 */
class UserModel {
	public function Login($route) {
		$data = array();
		if (!empty($_POST['sub'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			if (!empty($username) && !empty($password)) {
				if (User::Login($username, $password)) {
					session_start();
					$_SESSION['username'] = $username;
					$data['logined'] = true;
				} else {
					$data['logined'] = false;
				}
			}	
		}
		return $data;	
	}

}
?>
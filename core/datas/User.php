<?php
/**
    * 用户类
    */
class User {

	static public function Login($userName, $passWord) {
		$passWord = md5($passWord);
		$db_conn = Database::getInstance ();
		
		$sql = "select * from `user` where name=? and pwd=?;";
		$stmt = $db_conn->prepare ( $sql );
		$stmt->bindParam ( 1, $userName );
		$stmt->bindParam ( 2, $passWord );
		$query = $stmt->execute ();
		if ($query && $stmt->fetch ()) {
			return true;
		} else {
			return false;
		}
	}
}
?>
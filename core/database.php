<?php
/**
    * 数据库
    */
const APP_DB_DSN = 'mysql:host=localhost;dbname=lsdev';
const APP_DB_USER = 'root';
const APP_DB_PASSWORD = '';
class Database {
	private static $_instance = null;

	private function __construct() {
		return;
	}

	public static function getInstance() {
		if (! (self::$_instance instanceof PDO)) {
			try {
				self::$_instance = new PDO ( APP_DB_DSN, APP_DB_USER, APP_DB_PASSWORD );
			} catch ( Exception $e ) {
				echo "无法连接到数据库";
				exit ();
			}
		}
		return self::$_instance;
	}
}
?>
<?php
class Registry {
	private static $_registryStore = null;
	private static $_count = 0;
	
	private function __construct() {
		return;
	}
	
	static public function initRegistry() {
		if (self::$_registryStore == null) {
			$filePath = CONFIG_PATH . "config.json";
			$content = file_get_contents ( $filePath );
			self::$_registryStore =  json_decode ( $content,true );
		}
	}

	static public function add($object, $name = null) {
		$name = (! is_null ( $name ) ?  : get_class ( $object ));
		$name = strtolower ( $name );
		
		$return = null;
		if (isset ( self::$_registryStore [$name] )) {
			$return = self::$_registryStore [$name];
		}
		
		self::$_registryStore [$name] = $object;
		return $return;
	}

	static public function get($name) {
		if (! self::contains ( $name )) {
			throw new Exception ( "不存在" );
		}
		return self::$_registryStore [$name];
	}

	static public function contains($name) {
		if (! isset ( self::$_registryStore [$name] )) {
			return false;
		}
		return true;
	}

	static public function remove($name) {
		if (self::contains ( $name )) {
			unset ( self::$_registryStore [$name] );
		}
	}
}
?>
<?php

interface LogEngineInterface {
	public function add(array $data);
}

class FileLogEngine implements LogEngineInterface {

	public function add(array $data) {

		$line = '[' .date('r',$data['datetime']).'] '.
				$data['message'].PHP_EOL;
		$config = Registry::get('site-config');
		$logFileName = $config['log-location'];
		if (!file_exists($logFileName)) {
			$file = fopen($logFileName, "w");
			if ($file) {
				fclose($file);
			}
		}
		if (!file_put_contents($logFileName, $line,
				FILE_APPEND)) {
			throw new Exception("无法写入日志文件");
		}
	}
}


class Log {
	protected $engine = false;
	
	private static $_fileLog = null;
	private function __construct() {
		return;
	}
	
	public static function defaultLogEngine() {
		if (!(self::$_fileLog instanceof Log)) {
			$tempEngine = new FileLogEngine();
			self::$_fileLog = new Log();
			self::$_fileLog->setEngine($tempEngine);
		}
		return self::$_fileLog;
	}
	
	public function add($message) {
		if (!$this->engine) {
			throw new Exception('无法写日志，因为没有设置日志引擎');
		}
		date_default_timezone_set('UTC');
		$data['datetime'] = time();
		$data['message'] = $message;
				
		$this->engine->add($data);
	}
	
	public function setEngine(LogEngineInterface $engine) {
		$this->engine = $engine;
	}
	
	public function getEngine() {
		return $this->engine;
	}
}



?>
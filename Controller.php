<?php
define ( "MODEL_PATH", "app/model/" );
define ( "VIEW_PATH", "app/view/" );
define ( "EXTRAL_PATH", "core/extral/" );
define ( "DATA_PATH", "core/datas/" );
define ( "LIB_PATH", "core/lib/" );
define ( "CONFIG_PATH", "core/config/" );

require_once (EXTRAL_PATH . "Twig/autoload.php");
Twig_Autoloader::register ();
include_once ("core/database.php");
include_once (DATA_PATH . "Article.php");
include_once (DATA_PATH . "Category.php");
include_once (DATA_PATH . "User.php");
include_once (LIB_PATH . "set.php");
include_once (LIB_PATH . "RobinWuExtension.php");
include_once (LIB_PATH . "Registry.php");
include_once (LIB_PATH . "Log.php");
/**
 * 控制类
 */
class Controller {
	protected $router = false;

	function __construct() {
		Registry::initRegistry ();
	}

	public function dispatch($url, $default_data = array()) {
		try {
			if (! $this->router) {
				throw new Exception ( "没有设置路由" );
			}
			
			$route = $this->router->getRoute ( $url );
			
			$controller = ucfirst ( $route ['controller'] );
			$action = ucfirst ( $route ['action'] );
			
			unset ( $route ['controller'] );
			unset ( $route ['action'] );
			
			if ($controller == "Admin" && ! isLogin ()) {
				$controller = "user";
				$action = "login";
			}
			
			$model = $this->getModel ( $controller );
			$data = $model->{$action} ( $route );
			$data = $data + $default_data;
			$loader = new Twig_Loader_Filesystem ( 'templates' );
			$twig = new Twig_Environment ( $loader );
			$twig->addExtension ( new RobinWuExtension () );
			$view = $this->getView ( $controller, $action );
			$view->render ( $twig, $data );
		} catch ( Exception $e ) {
			$log = Log::defaultLogEngine ();
			$log->add ( $url . " " . $e->getMessage () );
			if ($url != '/error') {
				$data = array (
						'message' => $e->getMessage (),
						'action' => "index" 
				);
				
				$this->dispatch ( "/error", $data );
			} else {
				echo "<h1>一个未知的错误</h1>";
			}
		}
	}

	public function setRouter(RouterAbstract $router) {
		$this->router = $router;
	}

	public function getModel($name) {
		$name .= 'Model';
		$this->includeClass ( MODEL_PATH . $name );
		return new $name ();
	}

	public function getView($name, $action) {
		$this->includeClass ( VIEW_PATH . $name . '_' . $action . 'View' );
		$name .= $action . 'View';
		return new $name ();
	}

	protected function includeClass($name) {
		$file = str_replace ( '_', DIRECTORY_SEPARATOR, $name ) . '.php';
		if (! file_exists ( $file )) {
			throw new Exception ( "类无法找到" );
		}
		require_once $file;
	}
}
?>
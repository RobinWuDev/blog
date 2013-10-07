<?php 
include_once("Route.php");
include_once("Controller.php");

$router = new Router();
$router->addRoute('/int:categoryId/int:page/int:size',array('controller'=>'index','action'=>'index'));
$router->addRoute('/int:categoryId/int:page',array('controller'=>'index','action'=>'index'));
$router->addRoute('/int:categoryId',array('controller'=>'index','action'=>'index'));
$router->addRoute('/',array('controller'=>'index','action'=>'index'));
$router->addRoute('/alpha:controller/',array('action'=>'index'));
$router->addRoute('/alpha:controller',array('action'=>'index'));
$router->addRoute('/alpha:controller/alpha:action',array());
$router->addRoute('/alpha:controller/alpha:action/int:id',array());
$router->addRoute('/alpha:controller/alpha:action/int:categoryId/int:page',array());

$controller = new Controller();
$controller->setRouter($router);
$controller->dispatch($_SERVER['REQUEST_URI']);

?>
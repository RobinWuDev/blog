<?php

/**
 * 错误首页
 */
class ErrorIndexView {
	public function render($twig,$data = array()) {
		echo $twig->render ( 'error.twig',array('data'=>$data));
	}
}
?>
		

<?php
/**
 * 首页View
 */
class UserLoginView {
	public function render($twig,$data = array()) {
		echo $twig->render ( 'login.twig',array('data'=>$data));
	}
}
?>
		

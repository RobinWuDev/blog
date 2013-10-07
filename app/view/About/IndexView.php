<?php

/**
 * 关于我首页
 */
class AboutIndexView {
	public function render($twig,$data = array()) {
		echo $twig->render ( 'about.twig',array('data'=>$data));
	}
}
?>
		

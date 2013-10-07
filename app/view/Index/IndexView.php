<?php
/**
 * 首页View
 */
class IndexIndexView {
	public function render($twig,$data = array()) {
		echo $twig->render ( 'index.twig',array('data'=>$data));
	}
}
?>
		

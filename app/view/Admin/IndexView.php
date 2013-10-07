<?php

/**
 * 首页View
 */
class AdminIndexView {
	public function render($twig,$data = array()) {
		try {
			echo $twig->render ( 'admin/article_list.twig',array('data'=>$data));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}
?>
		

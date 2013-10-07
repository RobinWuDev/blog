<?php

/**
 * 首页View
 */
class AdminDelArticleView {
	public function render($twig,$data = array()) {
		try {
			echo $twig->render ( 'admin/del_article.twig',array('data'=>$data));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}
?>
		

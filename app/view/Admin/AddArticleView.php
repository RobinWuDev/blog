<?php

/**
 * 首页View
 */
class AdminAddArticleView {
	public function render($twig,$data = array()) {
		try {
			echo $twig->render ( 'admin/add_article.twig',array('data'=>$data));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>
		

<?php

/**
 * 首页View
 */
class AdminEditArticleView {
	public function render($twig,$data = array()) {
		try {
			echo $twig->render ( 'admin/edit_article.twig',array('data'=>$data));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}
?>
		

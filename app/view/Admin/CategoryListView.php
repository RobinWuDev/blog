<?php

/**
 * 首页View
 */
class AdminCategoryListView {
	public function render($twig,$data = array()) {
		try {
			echo $twig->render ( 'admin/category_list.twig',array('data'=>$data));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}
?>
		

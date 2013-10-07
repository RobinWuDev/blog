<?php
/**
 * 关于我模型
 */
class ArticleModel {
	public function Detail($route) {
		if (!empty ( $route['id'] )) {
			return Article::articleWithId($route['id']);
		} else {
			return nil;
		}
	}
	
}
?>
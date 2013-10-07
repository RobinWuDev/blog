<?php
/**
 * 管理模型
 */
class IndexModel {
	public function Index($route) {
		if (! empty ( $route ['page'] )) {
			$page = $route ['page'];
		} else {
			$page = 1;
		}
		
		if (! empty ( $route ['size'] )) {
			$size = $route ['size'];
		} else {
			$size = 10;
		}
		
		if (! empty ( $route ['categoryId'] ) && $route['categoryId'] != 0) {
			$category_id = $route ['categoryId'];
		}
		
		if (empty ( $category_id )) {
			$data = Article::index ( $page, $size );
		} else {
			$data = Article::index ( $page, $size, $category_id );
		}
		
		if (!empty ( $category_id )) {
			$data ['categoryId'] = $category_id;
		} else {
			$data ['categoryId'] = "0";
		}
		
		$data['categorys'] = Category::getIndexCategory();
				
		return $data;
	}

}
?>
<?php
/**
 * 首页模型
 */
class AdminModel {

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
		
		if (! empty ( $route ['categoryId'] ) && $route ['categoryId'] != 0) {
			$category_id = $route ['categoryId'];
		}
		
		if (empty ( $category_id ) && ! empty ( $route ['id'] )) {
			$category_id = $route ['id'];
		}
		
		if (empty ( $category_id )) {
			$data = Article::index ( $page, $size );
		} else {
			$data = Article::index ( $page, $size, $category_id );
		}
		
		if (! empty ( $category_id )) {
			$data ['categoryId'] = $category_id;
		} else {
			$data ['categoryId'] = "0";
		}
		$data ['categorys'] = Category::getIndexCategory ();
		return $data;
	}

	public function AddArticle($route) {
		$data ['categorys'] = Category::getIndexCategory ();
		if (! empty ( $_POST ['sub'] )) {
			$title = $_POST ['title'];
			$content = $_POST ['content'];
			$categoryId = $_POST ['category_id'];
			@$isPrivate = getCheckBoxValue ( $_POST ['isPrivate'] );
			@$isShare = getCheckBoxValue ( $_POST ['isShare'] );
			@$isComment = getCheckBoxValue ( $_POST ['isComment'] );
			$postData = array (
					"title" => $title,
					"category_id" => $categoryId,
					"content" => $content,
					"is_private" => $isPrivate,
					"is_share" => $isShare,
					"is_comment" => $isComment 
			);
			if (Article::addArticle ( $postData )) {
				$data ['add'] = true;
			} else {
				$data ['add'] = false;
			}
		}
		return $data;
	}

	public function EditArticle($route) {
		$data ['categorys'] = Category::getIndexCategory ();
		if (! empty ( $_POST ['sub'] )) {
			$id = $_POST ['id'];
			$title = $_POST ['title'];
			$content = $_POST ['content'];
			$categoryId = $_POST ['category_id'];
			@$isPrivate = getCheckBoxValue ( $_POST ['isPrivate'] );
			@$isShare = getCheckBoxValue ( $_POST ['isShare'] );
			@$isComment = getCheckBoxValue ( $_POST ['isComment'] );
			$postData = array (
					"id" => $id,
					"title" => $title,
					"category_id" => $categoryId,
					"content" => $content,
					"is_private" => $isPrivate,
					"is_share" => $isShare,
					"is_comment" => $isComment 
			);
			if (Article::editArticle ( $postData )) {
				$data ['edit'] = true;
			} else {
				$data ['edit'] = false;
			}
		} else {
			if (! empty ( $route ['id'] )) {
				$article = Article::articleWithId ( $route ['id'] );
				if (! empty ( $article )) {
					$article ['is_private'] = getCheckBoxEchoValue ( $article ['is_private'] );
					$article ['is_comment'] = getCheckBoxEchoValue ( $article ['is_comment'] );
					$article ['is_share'] = getCheckBoxEchoValue ( $article ['is_share'] );
					$data ['article'] = $article;
				}
			}
		}
		
		return $data;
	}

	public function DelArticle($route) {
		if (! empty ( $route ['id'] )) {
			$id = $route ['id'];
			if (Article::delArticle ( $id )) {
				$data ['del'] = true;
			} else {
				$data ['del'] = false;
			}
		} else {
			$data = array ();
		}
		return $data;
	}

	public function CategoryList($route) {
		$data ['categorys'] = Category::getIndexCategory ();
		return $data;
	}

	public function AddCategory($route) {
		if (! empty ( $_POST ['sub'] )) {
			if (! empty ( $_POST ['title'] )) {
				if (Category::addCategory($_POST['title'])) {
					$data['add'] = true;
				} else {
					$data['add'] = false;
				}
			}
		}
		$data ['categorys'] = Category::getIndexCategory ();
		return $data;
	}
	public function EditCategory($route) {
		if (!empty($_POST['editSub'])) {
			if (!empty($_POST['id']) && !empty($_POST['title'])) {
				if (Category::editCategory($_POST['id'], $_POST['title'])) {
					$data['edit'] = true;
				}else {
					$data['edit'] = false;
				}
			}
		} else {
			if (!empty($route['id'])) {
				$data['editId'] = $route['id'];
			}
		}
		$data ['categorys'] = Category::getIndexCategory ();
		return $data;
	}

	

	public function DelCategory($route) {
		if (!empty($route['id'])) {
			if (Category::delCategory($route['id'])) {
				$data['del'] = true;
			}else {
				$data['del'] = false;
			}
		}
		$data ['categorys'] = Category::getIndexCategory ();
		return $data;
	}
}
?>
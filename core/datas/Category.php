<?php
/**
    * 类别类
    */
class Category {
	public $id = nil;
	public $title = nil;
	public $create_time = nil;

	function __construct($pId, $pTitle, $pCreateTime) {
		$this->id = $pId;
		$this->title = $pTitle;
		$this->create_time = $pCreateTime;
	}

	static public function getIndexCategory() {
		$db_conn = Database::getInstance ();
		
		$sql = "select * from `category`  order by `create_time` desc ";
		$query = $db_conn->query ( $sql );
		$data = array ();
		while ( $rs = $query->fetch () ) {
			$rs ['count'] = Article::articleCountWithCategoryId ( $rs ['id'] );
			array_push ( $data, $rs );
		}
		return $data;
	}

	static public function getCategoryNameWithCategoryId($categoryId) {
		$db_conn = Database::getInstance ();
		$sql = "select * from `category`  where `id` = $categoryId; ";
		$query = $db_conn->query ( $sql );
		if ($rs = $query->fetch ()) {
			return $rs ['title'];
		} else {
			return "未知";
		}
	}

	static public function addCategory($title) {
		$db_conn = Database::getInstance ();
		$sql = "insert into `category` (`title`) values (?);";
		$stmt = $db_conn->prepare ( $sql );
		$stmt->bindParam ( 1, $title );
		$query = $stmt->execute ();
		return $query;
	}

	static public function delCategory($id) {
		$db_conn = Database::getInstance ();
		$sql = "delete from `category` where `id` = ?;";
		$stmt = $db_conn->prepare ( $sql );
		$stmt->bindParam ( 1, $id );
		$query = $stmt->execute ();
		return $query;
	}

	static public function editCategory($categryId, $categoryTitle) {
		$db_conn = Database::getInstance ();
		$sql = "update `category` set `title` = ? where `id` = ?;";
		$stmt = $db_conn->prepare ( $sql );
		$stmt->bindParam ( 1, $categoryTitle );
		$stmt->bindParam ( 2, $categryId );
		$query = $stmt->execute ();
		return $query;
	}
}
?>
<?php 
    /**
    * 文章类
    */
    class Article  {

        static public function index($page=1,$size=10,$category='')
        {
           $where = @"1";
           if ($category != '') {
           		$where = "category_id = '$category'";
           }
           $db_conn = Database::getInstance();
           
           $countSql = "select count(*) as count from `article` where $where ;";
           $countQuery = $db_conn->query($countSql);
           $countRs = $countQuery->fetch();
           $count = $countRs['count'];
           $totalPage = intval($count/$size);
           if ($count%$size != 0) {
               $totalPage++;
           }
           
           $return['totalPage'] = $totalPage;
           $return['currentPage'] = $page;

           
           $sql = "select * from `article` where $where order by `create_time` desc limit "
           		.(($page-1)*$size).",$size ;";
           $query = $db_conn->query($sql);
           $data = array();
           while($rs = $query->fetch()) {
           		$rs['category_name'] = Category::getCategoryNameWithCategoryId($rs['category_id']);
                array_push($data,$rs);
           }
           $return['articles'] = $data;
           
           return $return;
        } 
        
        static public function articleWithId($articleId)
        {
        	$db_conn = Database::getInstance();
        	         	 
        	$sql = "select * from `article` where `id` = '$articleId';";
        	$query = $db_conn->query($sql);
        	if($rs = $query->fetch()) {
        		$rs['category_name'] = Category::getCategoryNameWithCategoryId($rs['category_id']);
        		return $rs;
        	}
        	return nil;
        }

        static public function addArticle($article) {
        	$db_conn = Database::getInstance();
        	$sql = "insert into `article` (`title`,`category_id`,`content`,`is_private`,`is_share`,`is_comment`)"
        			."values (?,?,?,?,?,?);";
        	$stmt = $db_conn->prepare($sql);
        	$stmt->bindParam(1,$article['title']);
        	$stmt->bindParam(2,$article['category_id']);
        	$stmt->bindParam(3,$article['content']);
        	$stmt->bindParam(4,$article['is_private']);
        	$stmt->bindParam(5,$article['is_share']);
        	$stmt->bindParam(6,$article['is_comment']);
        	$query = $stmt->execute();
        	return $query;
        }
        
        static public function editArticle($article) {
        	
        	$db_conn = Database::getInstance();
        	$sql = "update `article` set `title` = ? , `content` = ?, `category_id`= ?,
        	`is_private`= ?,`is_share`= ?,`is_comment`= ? where id = ?;";
        	$stmt = $db_conn->prepare($sql);
        	$stmt->bindParam(1,$article['title']);
        	$stmt->bindParam(2,$article['content']);
        	$stmt->bindParam(3,$article['category_id']);
        	$stmt->bindParam(4,$article['is_private']);
        	$stmt->bindParam(5,$article['is_share']);
        	$stmt->bindParam(6,$article['is_comment']);
        	$stmt->bindParam(7,$article['id']);
        	$query = $stmt->execute();
        	return $query;
        }
        
        static public function delArticle($articleId) {
        	 
        	$db_conn = Database::getInstance();
        	$sql = "delete from `article` where `id` = ?;";
        	$stmt = $db_conn->prepare($sql);
        	$stmt->bindParam(1,$articleId);
        	$query = $stmt->execute();
        	return $query;
        }
        
        static public function articleCountWithCategoryId($categoryId) {
        
        	$db_conn = Database::getInstance();
        	$sql = "select count(*) as count from `article` where `category_id`= '$categoryId'";
        	$query = $db_conn->query($sql);
        	if ($rs = $query->fetch()) {
        		return $rs['count'];
        	} else {
        		return 0;
        	}
        	
        }
        
    }
 ?>
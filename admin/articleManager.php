<?php 
  include_once("../set.php");
  include_once("top.html");
  include_once(MYROOT."/conn.php");
 ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list" id="admin_left_categorys">
          <li class="nav-header">博客管理</li>
          <li >
            <a href="/admin/addArticle.php">发布文章</a>
          </li>
          <li >
            <a href="/admin/categoryManager.php">类别管理</a>
          </li>
          <li class="nav-header">文章管理</li>
          <li >
          <a href='articleManager.php'>全部</a>
          </li>
          <?php include_once("leftCategory.php"); ?> 
      </ul>
    </div>
  </div>
  <div class="span9" id="content">
    <h3 id="article_h3">文章列表</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>标题</th>
          <th>发表时间</th>
          <th>分类</th>
          <th>管理</th>
        </tr>
      </thead>
      <tbody id="article_list">
        <?php
           $page = 1;
           if (!empty($_GET['page'])) {
               $page = $_GET['page'];
           }

           $w = "1";
           if (!empty($_GET['category_id'])) {
               $category = $_GET['category_id'];
               $w = "category_id = '$category'";
           }

           $pageSize = 10;
           $countSql = "select count(*) as count from `article` where $w ;";
           $countQuery = mysql_query($countSql);
           $countRs = mysql_fetch_array($countQuery);
           $count = $countRs['count'];
           $totalPage = intval($count/$pageSize);
           if ($count%$pageSize != 0) {
               $totalPage++;
           }

            $sql = "select * from `article` where $w limit ".(($page-1)*$pageSize).",$pageSize;";
            $query = mysql_query($sql);
            while ($rs = mysql_fetch_array($query)) {
           ?>
        <tr >
          <td><a href="view.php?id=<?php echo $rs['id']; ?>"><?php echo $rs['title']; ?></a></td>
          <td><?php echo $rs['create_time']; ?></td>

          <?php 
                $categoryId = $rs['category_id'];
                $categorySql = "select * from `category` where id='$categoryId';";
                $query2 = mysql_query($categorySql);
                $categoryRs = mysql_fetch_array($query2);
              ?>
          <td><?php echo $categoryRs['title']; ?></td>
          <td><a href="edit.php?id=<?php echo $rs['id']; ?>">编辑</a>|<a href="del.php?del=<?php echo $rs['id']; ?>">删除</a></td>
        </tr>
        <?php } ?></tbody>
    </table>
    <div id="example" class="span9 offset2" style="text-align: right;margin-bottom: 30px;"></div>
  </div>
</div>
</div>


<script type='text/javascript'>
      var options = {
        currentPage: <?php echo $page;?>,
        totalPages: <?php echo $totalPage;?>,
        pageUrl: function(type, page, current){
            <?php 
                $w = "''";
                if (!empty($_GET['category_id'])) {
                    $category = $_GET['category_id'];
                    $w = "'&category_id=$category'";
                }
            ?>
            return "articleManager.php?page="+page+<?php echo $w;?>;

        }
    }

$('#example').bootstrapPaginator(options);
</script>

<?php 
  include_once("bottom.html");
 ?>
<?php 
include_once("top.html");
include_once("conn.php");
include_once("extral/markdown/Markdown.php");
 ?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list" id="categorys">
          <li class="nav-header">文章类别</li>
          <?php include_once("leftCategory.php"); ?> 
        </ul>
      </div>
      </div>
    <div class="span9" id="articles">
         <?php
           $page = 1;
           if (!empty($_GET['page'])) {
               $page = $_GET['page'];
           }

           if (!isLogin()) {
             $w = "is_private='0'";
           }

           if (!empty($_GET['category_id'])) {
               $category = $_GET['category_id'];
               if (empty($w)) {
                 $w = "category_id = '$category'";
               } else {
                 $w .= " and category_id = '$category'";
               }       
           } else {
              if (empty($w)) {
                $w = "1";
              }
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

            $sql = "select * from `article` where $w order by `create_time` desc limit ".(($page-1)*$pageSize).",$pageSize ;";
            $query = mysql_query($sql);
            while ($rs = mysql_fetch_array($query)) {
           ?>
            <div class='hero-unit'>
             <h3><a href="view.php?id=<?php echo $rs['id']; ?>"><?php echo $rs['title']; ?></a></h3>
             <?php 
                $categoryId = $rs['category_id'];
                $categorySql = "select * from `category` where id='$categoryId';";
                $query2 = mysql_query($categorySql);
                $categoryRs = mysql_fetch_array($query2);
              ?>
             <p>文章类别:<a href="index.php?category_id=<?php echo $rs['category_id']; ?>"><?php echo $categoryRs['title']; ?></a></p>
             <p><?php echo $rs['create_time']; ?></p>
             <p ><?php echo $my_html = Michelf\Markdown::defaultTransform($rs['content']); ?></p>
            </div>
          <?php } ?>
    </div>
    <div id="example" class="span9 offset2" style="text-align: right;margin-bottom: 30px;"></div>             
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
            return "index?page="+page+<?php echo $w;?>;

        }
    }

$('#example').bootstrapPaginator(options);
</script>

 <?php 
include_once("bottom.html");
 ?>
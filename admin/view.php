<?php 
  include_once("top.html");
  include_once(MYROOT."/conn.php");
  include_once(MYROOT."/extral/markdown/Markdown.php");
  
  if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from `article` where id = '$id'";
        $query = mysql_query($sql);
        $rs = mysql_fetch_array($query);

        // $sql = "update `news` set hits=hits+1 where `id` = '$id';";
        // mysql_query($sql);
    }  
 ?>
<div class="container row-fluid">
  <div class="span2"></div>
  <div class="span8">
    <h2 align="center"><?php echo $rs['title']; ?></h2>
    <div class="row">
      <div class="span4 offset2">
        <?php 
                $categoryId = $rs['category_id'];
                $categorySql = "select * from `category` where id='$categoryId';";
                $query2 = mysql_query($categorySql);
                $categoryRs = mysql_fetch_array($query2);
              ?>
        文章类别:<?php echo $categoryRs['title']; ?>
      </div>
      <div class="span4 offset2">
        <?php echo $rs['create_time']; ?>
      </div>

    </div>
   <hr>
    <p ><?php echo $my_html = Michelf\Markdown::defaultTransform($rs['content']); ?></p>
  </div>
  <div class="span2"></div>
</div>
<!-- Le javascript
<?php 
  include_once("bottom.html");
 ?>


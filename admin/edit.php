<?php 
  include_once("../set.php");
  include_once("top.html");
  include_once(MYROOT."/conn.php");
 
  if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from `article` where id = '$id'";
        $query = mysql_query($sql);
        $editRs = mysql_fetch_array($query);


    }

    
    if (!empty($_POST['sub'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $id = $_POST['id'];
        $categoryId = $_POST['category_id'];
        $sql = "update `article` set `title` = '$title' , `content` = '$content', `category_id`='$categoryId' where id = '$id';";
        mysql_query($sql);
        echo "<script>alert('更新成功');location.href='articleManager.php';</script>";
    }

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
          <?php 
            $sql = "select * from `category`;";
            $query = mysql_query($sql);
            while ($rs = mysql_fetch_array($query)) {
           ?>
          <?php
               $category = "";
               if (!empty($_GET['category_id'])) {
                   $category = $_GET['category_id'];
               }
               if ($category == $rs['id']) {
                echo "<li class='active'>
          <a>".$rs['title']."</a>
        </li>
        ";
               } else {
                echo "
        <li >
          <a href='articleManager.php?category_id=".$rs['id']."'>".$rs['title']."</a>
        </li>
        ";
               }
           }
           ?>
      </ul>
    </div>
  </div>


  <!-- 内容 -->
  <link rel="stylesheet" type="text/css" href="/static/css/demo.css" />
  <div class="span9" id="content">
    <script type="text/javascript" src="/static/js/external/Markdown.Converter.js"></script>
    <script type="text/javascript" src="/static/js/external/Markdown.Sanitizer.js"></script>
    <script type="text/javascript" src="/static/js/external/Markdown.Editor.js"></script>
    <div class="row-fluid">
      <div class="well">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form id="tab" class="form-horizontal" action="edit.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $editRs['id']; ?>"/>
              <div class="control-group">
                文章标题:
                <input type="text" name="title" id="add_article_title" value="<?php echo $editRs['title']; ?>" class="input-xlarge">
                <span class="text-error" id="add_article_prompt_info"></span>
              </div>
              <div class="control-group">
                选择类别:
                <select name="category_id" id="select_category">
                  <?php 
                  $sql = "select * from `category`;";
                  $query = mysql_query($sql);
                  while ($rs = mysql_fetch_array($query)) {
                   ?>
                   <?php
                    if ($rs['id'] == $editRs['category_id']) {
                       echo "<option selected='selected' value=".$rs['id'].">".$rs['title']."</option>";
                     }else {
                      echo "<option value=".$rs['id'].">".$rs['title']."</option>";
                     } 
                    ?>
                  
                  <?php } ?>
                </select>
              </div>

              <div class="wmd-panel">
                <div id="wmd-button-bar"></div>
                <textarea name="content" class="wmd-input" id="wmd-input"><?php echo $editRs['content']; ?></textarea>
              </div>
              <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
              <div class="btn-toolbar">
                <input class="btn btn-primary" type="submit" name="sub" id="sub" value="更新"/>
              </div>
            </form>
          </div>
        </div>

      </div>
      <script type="text/javascript">
    (function () {
          var converter1 = Markdown.getSanitizingConverter();
          var editor1 = new Markdown.Editor(converter1);
          editor1.run();
    })();
    </script>
    </div>
  </div>

  <!-- 内容 -->

</div>
</div>

<?php 
  include_once("bottom.html");
 ?>
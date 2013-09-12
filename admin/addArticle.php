<?php 
  include_once("top.html");
  include_once(MYROOT."/conn.php");

    if (!empty($_POST['sub'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $categoryId = $_POST['category_id'];
        @$isPrivate = getCheckBoxValue($_POST['isPrivate']);
        @$isShare = getCheckBoxValue($_POST['isShare']);
        @$isComment = getCheckBoxValue($_POST['isComment']);

        $sql = "insert into `article` (`id`,`title`,`category_id`,`content`,`is_private`,`is_share`,`is_comment`) values "
        ."(null,'$title',$categoryId,'$content','$isPrivate','$isShare','$isComment');";
        mysql_query($sql);
        echo "<script>alert('添加成功');</script>";
    }

 ?>

<link rel="stylesheet" type="text/css" href="/static/css/demo.css" />

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list" id="admin_left_categorys">
          <li class="nav-header">博客管理</li>
          <li  class='active'>
            <a href="">发布文章</a>
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


  <!-- 内容 -->
  
  <div class="span9" id="content">
    <div class="row-fluid">
      <div class="well">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form id="tab" class="form-horizontal" action="addArticle.php" method="POST">
              <div class="control-group">
                文章标题:
                <input type="text" name="title" id="add_article_title" value="" class="input-xlarge">
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
                  <option value="<?php echo $rs['id']; ?>"><?php echo $rs['title']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="control-group">
                <label class="checkbox">
                    <input type="checkbox" name="isPrivate"> 不公开
                </label>
                <label class="checkbox" >
                    <input type="checkbox" name="isShare" checked="checked"> 允许分享
                </label>
                <label class="checkbox">
                    <input type="checkbox" name="isComment" checked="checked"> 允许评论
                </label>
              </div>
              <div class="wmd-panel">
                <div id="wmd-button-bar"></div>
                <textarea name="content" class="wmd-input" id="wmd-input"></textarea>
              </div>
              <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
              <div class="btn-toolbar">
                <input class="btn btn-primary" type="submit" name="sub" id="sub" value="发布"/>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 内容 -->

</div>
</div>

<script type="text/javascript" src="/static/js/external/Markdown.Converter.js"></script>
<script type="text/javascript" src="/static/js/external/Markdown.Sanitizer.js"></script>
<script type="text/javascript" src="/static/js/external/Markdown.Editor.js"></script>
<script type="text/javascript">
  (function () {
      var converter1 = Markdown.getSanitizingConverter();
      var editor1 = new Markdown.Editor(converter1);
      editor1.run();
  })();
</script>

<?php 
  include_once("bottom.html");
 ?>
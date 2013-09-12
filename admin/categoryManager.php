<?php 
  include_once("top.html");
  include_once(MYROOT."/conn.php");
     
    if (!empty($_POST['sub'])) {
        $title = $_POST['title'];
        $sql = "insert into `category` (`title`) values ('$title');";
        mysql_query($sql);
        echo "<script>alert('添加成功');</script>";
    }

    if (!empty($_GET['del'])) {
        $delId = $_GET['del'];
        $delSql = "delete from `category` where `id`=$delId";
        mysql_query($delSql);
        echo "<script>alert('删除成功');</script>";
    }

    if (!empty($_GET['edit'])) {
        $editId = $_GET['edit'];
    }

    if (!empty($_GET['editSub'])) {
        $editId2 = $_GET['id'];
        $editTitle = $_GET['title'];
        $editSql = "update `category` set `title` = '$editTitle' where id = '$editId2';";
        mysql_query($editSql);
        echo "<script>alert('更新成功');</script>";
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
          <li class='active'>
            <a href="">类别管理</a>
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
    <p class="text-error" id="prompt_info"></p>
    <h3>类别管理</h3>
    <form class="form-inline" action="categoryManager.php" method="POST">  
      新增博客分类  : 
      <input  placeholder="请输入类别名称" name="title" size="30" type="text" id="category_title" /> 
      <input class="submit" name="sub" id="submit_button" type="submit" value="提交" />
    </form>
    <table class="table table-hover" >
        <thead>
            <tr>
              <td>名称</td>
              <td>文章数量</td>
              <td>管理</td>
            </tr>
        </thead>
        <tbody id="category_list">
          <?php 
            $sql = "select * from `category`;";
            $query = mysql_query($sql);
            while ($rs = mysql_fetch_array($query)) {
              if (!empty($editId) && $rs['id'] == $editId) {
           ?>
            <tr>
              <td colspan='3'>
               <form class='form-inline' action="categoryManager.php" method="GET">
                <div>
                    <input type="hidden" name="id" value="<?php echo $rs['id']; ?>" />
                   <input id='edit_category_name_input' name="title" size='30' type='text' value='<?php echo $rs['title']; ?>' />
                   <input class='submit' name="editSub"  type='submit' value='保存'id='edit_save_button' />
                   <a href="categoryManager.php"><input type='button' value='取消' class='button' id='edit_cancel_button'/></a>
               </form>
             </td> 
           </tr>
            <?php
            } else {
             ?>
            <tr>
              <td><?php echo $rs['title']; ?></td>
              <?php 
                $countSql = "select count(*) as count from `article` where `category_id`=".$rs['id'];
                $countQuery = mysql_query($countSql);
                $countRs = mysql_fetch_array($countQuery);
               ?>
              <td><?php echo $countRs['count']; ?></td>
              <td><a href="categoryManager.php?edit=<?php echo $rs['id']; ?>">编辑 </a><a href="categoryManager.php?del=<?php echo $rs['id']; ?>">删除 </a></td>
            </tr>
          <?php
            }
           }
           ?>
            
        </tbody>
    </table>
</div>

  <!-- 内容 -->

</div>
</div>

<?php 
  include_once("bottom.html");
 ?>
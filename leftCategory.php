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
        echo "<li class='active'><a>".$rs['title']."</a></li>";
       } else {
        echo "<li ><a href='index.php?category_id=".$rs['id']."'>".$rs['title']."</a></li>";
       }
   }
?>
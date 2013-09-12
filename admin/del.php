<?php 
    include_once("top.html");
    include_once(MYROOT."/conn.php");

    if (!empty($_GET['del'])) {
        $d = $_GET['del'];
        $sql = "delete from `article` where `id` = '$d';";
        mysql_query($sql);
        echo "<script>alert('删除成功');</script>";
    }
    include_once("bottom.html");
 ?>
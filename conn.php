<?php 
    @mysql_connect("localhost","root","") or die("Mysql 连接失败");
    @mysql_select_db("lsdev") or die("db连接失败");
    @mysql_set_charset("utf8") or die("设置编码错误");

 ?>
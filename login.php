<?php 
include_once("set.php");
include_once("top.html");
include_once("conn.php");

  if (!empty($_POST['sub'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from `user` where name='$username' and pwd='$password';";
    $query = mysql_query($sql);
    if (mysql_fetch_array($query)) {
      session_start();
      $_SESSION['username'] = $username;
      echo "<script>location.href='/admin/articleManager.php'</script>";
    } else {
      echo "<script>alert('登录失败');</script>";
    }
  }

 ?>

<style type="text/css">
.form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
.form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
}
</style>
<div class="container">

    <form class="form-signin" action="login.php" method="POST">
    <h2 class="form-signin-heading">请登录</h2>
    <input id="text" type="text" class="input-block-level" placeholder="Email address" name="username">
    <input id="password" type="password" class="input-block-level" placeholder="Password" name="password">
    <input id="login_button" name="sub" class="btn btn-large btn-primary" type="submit" value="登录"/>
  </form>
   <div>
    <p class="text-error" id="login_prompt_info" align="center"></p>
  </div>
  


</div>
<!-- /container -->

 <?php 
include_once("bottom.html");
 ?>
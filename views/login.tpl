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

    <form class="form-signin">
    <h2 class="form-signin-heading">请登录</h2>
    <input id="text" type="text" class="input-block-level" placeholder="Email address">
    <input id="password" type="password" class="input-block-level" placeholder="Password">
    <button id="login_button" class="btn btn-large btn-primary" type="button">登录</button>
  </form>
   <div>
    <p class="text-error" id="login_prompt_info" align="center"></p>
  </div>
  


</div>
<!-- /container -->

<script type="text/javascript" src="/static/js/controller/login.js"></script>
<?php

function getCheckBoxValue($value) {
      if ( $value == "on") {
          return 1;
        } else {
          return 0;
        }
    }

function getCheckBoxEchoValue($value) {
      if ( $value == 1) {
          return 'checked="checked"';
        } else {
          return ;
        }
    }

function isLogin() {
     session_start();
    if (empty($_SESSION['username'])) {
        return false;
    } else {
        return true;
    }
}
 ?>
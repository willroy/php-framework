<?php

class Auth extends Controller {
  public static function form() {
    parent::render();
  }

  public static function save() {
    global $_GET;
    global $_COOKIE;

    setcookie("auth_secret", $_GET['auth_secret'], time() + (86400 * 30), "/");

    parent::redirect("/");
  }
}

?>
<?php

class Controller {
  public static function render($args = []) {
    global $_COOKIE;
    global $twig;
    global $ini;

    $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
    $caller = $trace[1];
    $controller_class = strtolower($caller["class"]);
    $controller_method = $caller["function"];

    $args["auth_secret"] = $_COOKIE['auth_secret'];
    $args["ini"] = $ini;
    $args["path"] = $controller_class . "/" . $controller_method;

    echo $twig->render($controller_class . "/" . $controller_method . ".html.twig", $args);
  }

  public static function template($path) {
    include "views/" . $path . ".php";
  }

  public static function redirect($url) {
    header('Location: ' . $url);
  }
}

?>
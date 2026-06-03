<?php

// load

require_once 'vendor/autoload.php';

$ini = parse_ini_file('app.ini');
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader);

require_once("base/controller.php");
require_once('controllers/admin.php');
require_once('controllers/auth.php');
require_once('controllers/form.php');
require_once('controllers/index.php');

// get request url

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// define routes

$errors = array(
    "/400" => "/views/errors/400.php",
    "/403" => "/views/errors/403.php",
    "/404" => "/views/errors/404.php"
);

$routes = array(
    "/" => "Index::view",
    "/auth/form" => "Auth::form",
    "/auth/save" => "Auth::save"
);

$authenticated_routes = array(
    "/form/form" => "Form::form",
    "/form/save" => "Form::save",
    "/admin" => "Admin::view"
);

// search routes against url

foreach ($errors as $key => $error) {
	if ( $uri == $key ) {
        include __DIR__ . $error;
        exit;
    }
}


foreach ($routes as $key => $route) {
    if ( $uri == $key ) {
        echo call_user_func($route);
        exit;
    }
}

// throw 403 if unathenticated

foreach ($authenticated_routes as $key => $route) {
	if ( $uri == $key ) {
	if (!isset($_COOKIE["auth_secret"]) or $_COOKIE["auth_secret"] != $ini['secret']) { header('Location: /403'); exit; }
        echo call_user_func($route);
        exit;
    }
}

// throw 404 if not found

header('Location: /404');

?>
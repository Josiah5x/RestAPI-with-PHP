<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
// var_dump($uri);
require PROJECT_ROOT_PATH . "/Controller/API/UserController.php"; 
$obj = new UserController();
$method = $uri[3]."/".$uri[4];
$obj->$method();


?>

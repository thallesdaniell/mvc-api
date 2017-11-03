<?php
require_once('./config/bootstrap.php');

require_once('vendor/autoload.php');

$uri = isset($_GET['uri']) ? $_GET['uri'] : '';

$router = Seed\Router::getInstance($uri);

$router->run();


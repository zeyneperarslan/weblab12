<?php
require __DIR__ . '/../core/Database.php';
require __DIR__ . '/../model/Url.php';
require __DIR__ . '/../controller/UrlController.php';
require __DIR__ . '/../core/Router.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router();
$router->direct($uri);

<?php
require_once 'Libs/Router.php';
require_once 'Controller/TableApiController.php';

$router = new Router();

$router->addRoute('', '', '', '');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>
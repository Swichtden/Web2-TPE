<?php
require_once 'Libs/Router.php';
require_once 'Controller/CommentsApiController.php';

$router = new Router();

$router->addRoute('Comentarios/:ID_Budget', 'GET', 'CommentsApiController', 'getComments');
$router->addRoute('Comentario', 'POST', 'CommentsApiController', 'AddComment');
$router->addRoute('Comentario/:ID', 'DELETE', 'CommentsApiController', 'deleteComment');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>
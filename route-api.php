<?php
require_once 'Libs/Router.php';
require_once 'Controller/CommentsApiController.php';

$router = new Router();

$router->addRoute('Comentarios/:ID_Budget', 'GET', 'CommentsApiController', 'getComments');
$router->addRoute('Comentario', 'POST', 'CommentsApiController', 'AddComentary');
$router->addRoute('Comentario/:ID', 'DELETE', 'CommentsApiController', 'deleteComentary');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>
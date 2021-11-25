<?php
require_once 'Libs/Router.php';
require_once 'Controller/CommentsApiController.php';

$router = new Router();

$router->addRoute('Comentarios', 'GET', 'CommentsApiController', 'getComentary');
$router->addRoute('Comentario/:ID', 'POST', 'CommentsApiController', 'AddComentary');
$router->addRoute('Comentario/:ID', 'DELETE', 'CommentsApiController', 'deleteComentary');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>
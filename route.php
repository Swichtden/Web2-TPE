<?php
require_once "controller/TableController.php";
//require_once "controller/LoginController.php";
define('BASE_URL',  '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/'); 

$TableController = new TableController;
//$LoginController = new LoginController;

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}
else{
    $action = 'home';
}

switch ($action) {
    case 'home':
       $TableController->showBudgets();
        break;
   //case 'presupuesto':
        
     //   break;
    default:
        echo "ERROR 404: Pagina no encontrada a";
        break;
    }


?>
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

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $TableController->showBudgets();
        break;
    case 'presupuesto':  //se agrego la tabla presupuesto con nombre del cliente y monto.
        $TableController->showBudget($params[1]);
        break;
   case 'materiales'://se agrega los detalles de la lista materiales.
        $TableController->showMaterialesLista();
        break;
    case 'material':
        if (!empty($params[1])){
            $TableController->showMaterialesxPresupuesto($params[1]);
        }
        else{
            echo "Seleccione una categoria";
            $TableController->showMaterialesLista();
        }
            break;
    default:
        echo "ERROR 404: Pagina no encontrada a";
        break;
    }


?>
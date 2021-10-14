<?php
require_once "Controller/TableController.php";
require_once "Controller/LoginController.php";

define('BASE_URL',  '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/'); 

$TableController = new TableController;
$LoginController = new LoginController;

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
    case 'login':
        $LoginController->login();
        break;
    case 'logout':
        $LoginController->logout();
        break;
    case 'verifyLogin':
        $LoginController->verifyLogin();
        break;
    case 'presupuesto':  //se agrego la tabla presupuesto con nombre del cliente y monto.
        switch ($params[1]){
            case 'edit':
                $TableController->showBudget($params[2], 1);
                break;
            case 'delete':
                var_dump($params);
                //$TableController->deletePresupuesto($params[2]); //lo comento para no llamar al de borrar por error
                break;
            default:
                $TableController->showBudget($params[1], 0);
        }
        break;
    case 'editDB':
        $TableController-> updatePresupuesto();
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
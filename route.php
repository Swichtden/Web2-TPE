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
    case 'presupuestos':
        $TableController->showBudgets();
        break;
    case 'presupuesto':  //se agrego la tabla presupuesto con nombre del cliente y monto.
        if (isset($params[1]))
            switch ($params[1]){
                case 'edit':
                    $TableController->showBudget($params[2], 1);
                    break;
                case 'delete':
                    $TableController->deletePresupuesto($params[2]); //lo comento para no llamar al de borrar por error
                    break;
                default:
                    $TableController->showBudget($params[1], 0);
            }
        else{
            echo ("Seleccione un presupuesto");
            $TableController->showBudgets();
        }
        break;
    case 'createPresupuesto':
        $TableController->createPresupuesto();
        break;
    case 'editPresupuesto':
        $TableController-> updatePresupuesto();
        break;
    case 'materiales':
            $TableController->showMateriales();
            break;
    case 'material'://se agrega los detalles de la lista materiales.
        if (isset($params[1]))
            switch ($params[1]){
                case 'edit':
                    $TableController->showMaterial($params[2], 1);
                    break;
                case 'delete':
                    $TableController->deleteMaterial($params[2]); //lo comento para no llamar al de borrar por error
                    break;
                default:
                    echo("Esa funcion no existe");
                    $TableController->showMateriales();
            }
        else{
            echo ("Seleccione un material");
            $TableController->showMateriales();
        }
        break;

    case 'createMaterial':
            $TableController->createMaterial();
        break;
    case 'editMaterial':
            $TableController->updateMaterial();
        break;       
    case 'filtroMaterial':
        if (!empty($params[1])){
            $TableController->showPresupuestosXMaterial($params[1]);
        }
        else{
            echo "Seleccione una categoria";
            $TableController->showMateriales();
        }
        break;
    default:
        echo "ERROR 404: Pagina no encontrada a";
        break;
    }


?>
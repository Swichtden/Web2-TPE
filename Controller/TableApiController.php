<?php
require_once "./Model/MaterialesModel.php";
require_once "./Model/PresupuestoModel.php";
require_once "./View/ApiView.php";

class ApiTaskController{

    private $MaterialModel;
    private $PresupuestoModel;
    private $view;

    function __construct(){
        $this->MaterialModel = new MaterialModel();
        $this->PresupuestoModel = new PresupuestoModel();
        $this->view = new ApiView();
    }


}
?>
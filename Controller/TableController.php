<?php
require_once "./Model/TableModel.php";
require_once "./View/TableView.php";

    class TableController{

        private $TableModel;
        private $TableView;

        function __construct(){
                $this -> TableModel = new TableModel();
                $this -> TableView = new TableView();
        }

        function showBudgets(){
            $budgets = $this->TableModel->getBudgets();
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos", $listaMateriales);
        }

        function showBudget($id_cliente, $edit=false){
            $budget = $this->TableModel->getBudget($id_cliente);
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showBudget($budget, $listaMateriales, $edit);
        }

        function showMateriales(){
            $materiales=$this->TableModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

        function showMaterial($id_material){
            $materiales=$this->TableModel->getMaterial($id_material);
            $this->TableView->showMaterial($materiales);
        }

        function showPresupuestosXMaterial($material){
            $MaterialesxPresupuesto=$this->TableModel->getMaterialesxPresupuesto($material);
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showTable($MaterialesxPresupuesto, "Lista de clientes por material",$listaMateriales);
        }

        function createPresupuesto(){
            
            $this->TableModel->insertPresupuesto($_POST['Cliente'], $_POST['Monto'], $_POST['Material']);
            $budgets = $this->TableModel->getBudgets();
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
        }
    
        function createMaterial(){
            $this->TableModel->insertMaterial($_POST['Material'], $_POST['Precio'], $_POST['Descripcion']);
            $materiales=$this->TableModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

        function deletePresupuesto($id){
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]) && $_SESSION["rol"]){
                $this->TableModel->deletePresupuesto($id);
                
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
            $budgets = $this->TableModel->getBudgets();
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
            }
        
        function deleteMaterial($id){
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]) && $_SESSION["rol"]){
                $this->TableModel->deleteMaterial($id);
               
            }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
                $materiales=$this->TableModel->getMateriales();
                $this->TableView->showTableMateriales($materiales);
        }
        function updatePresupuesto(){
            $this->TableModel->updatePresupuesto($_POST['id_cliente'], $_POST['Cliente'], $_POST['Monto'], $_POST['Material']);
            $budgets = $this->TableModel->getBudgets();
            $listaMateriales = $this->TableModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
        }
        
        function updateMaterial(){
            $this->TableModel->updateMaterial($_POST['id_material'],$_POST['Material'], $_POST['Precio'], $_POST['Descripcion']);
            $materiales = $this->TableModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

    }
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
            $this->TableView->showTable($budgets);
        }

        function showBudget($id_cliente){
            $budget = $this->TableModel->getBudget($id_cliente);
            $this->TableView->showBudget($budget);
        }

        function showMaterialesLista(){
            $materialesLista=$this->TableModel->getMaterialesLista();
            $this->TableView->showTableMateriales($materialesLista);
        }

        function showMaterialesxPresupuesto($material){
            $MaterialesxPresupuesto=$this->TableModel->getMaterialesxPresupuesto($material);
            $this->TableView->showMaterialesxPresupuesto($MaterialesxPresupuesto);
        }

        function createPresupuesto(){
            $this->TableModel->insertPresupuesto($_POST['nombre_cliente'], $_POST['monto'], $_POST['FK_id_material']);
            $budgets = $this->TableModel->getBudgets();
            $this->TableView->showTable($budgets);
        }
    
        function createMaterial(){
            $this->TableModel->insertMaterial($_POST['nombre_material'], $_POST['precio_material'], $_POST['descripcion']);
            $materialesLista=$this->TableModel->getMaterialesLista();
            $this->TableView->showTableMateriales($materialesLista);
        }

        function deletePresupuesto($id){
            $this->model->deletePresupuesto($id);
            $budgets = $this->TableModel->getBudgets();
            $this->TableView->showTable($budgets);
        }
        
        function deleteMaterial($id){
            $this->model->deleteMaterial($id);
            $materialesLista=$this->TableModel->getMaterialesLista();
            $this->TableView->showTableMateriales($materialesLista);
        }
        function updatePresupuesto($id, $nombre, $monto, $material){
            $this->model->updatePresupuesto($id, $nombre, $monto, $material);
            $budgets = $this->TableModel->getBudgets();
            $this->TableView->showTable($budgets);
        }
        
        function updateMaterial($id, $nombre, $precio, $descripcion){
            $this->model->updateMaterial($id, $nombre, $precio, $descripcion);
            $budgets = $this->TableModel->getBudgets();
            $this->TableView->showTable($budgets);
        }

    }
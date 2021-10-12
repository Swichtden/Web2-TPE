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
    }
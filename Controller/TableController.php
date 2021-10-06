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
    }
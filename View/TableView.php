<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
    
    class TableView{

        private $smarty;

        function __construct() {
            $this->smarty = new Smarty();
        }

        function showTable($budgets){
            
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budgets', $budgets);
            session_start();
            $this->smarty->assign('rol', $_SESSION["rol"]);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }

        function showBudget($budget, $edit){
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budget', $budget);
            $this->smarty->assign('Edit', $edit);
            $this->smarty->display('Templates/TableBudget.tpl');
        }

        function showTableMateriales($materialesLista){
            $this->smarty->assign('Title', 'Lista de Materiales');
            $this->smarty->assign('MaterialesLista',$materialesLista);
            $this->smarty->display('Templates/TableMateriales.tpl');
        }

        function showMaterialesxPresupuesto($MaterialesxPresupuesto){
            $this->smarty->assign('Title','Lista de clientes por material');
            session_start();
            $this->smarty->assign('rol', $_SESSION["rol"]);
            $this->smarty->assign('Budgets',$MaterialesxPresupuesto);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }
    }
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
            $this->smarty->display('Templates/TableBudgets.tpl');
        }

        function showBudget($budget){  
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budget', $budget);
            $this->smarty->display('Templates/TableBudget.tpl');
        }

        function showTableMateriales($materialesLista){
            $this->smarty->assign('Title', 'Lista de Materiales');
            $this->smarty->assign('MaterialesLista',$materialesLista);
            $this->smarty->display('Templates/TableMateriales.tpl');
        }

        function showMaterialesxPresupuesto($MaterialesxPresupuesto){
            $this->smarty->assign('Title','Lista de clientes por material');
            $this->smarty->assign('Budgets',$MaterialesxPresupuesto);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }
    }
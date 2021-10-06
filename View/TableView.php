<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
    
    class TableView{

        private $smarty;

        function __construct() {
            $this->smarty = new Smarty();
        }

        function showTable($budgets){
            var_dump($budgets);
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budgets', $budgets);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }

    }
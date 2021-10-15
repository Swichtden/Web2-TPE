<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
    
    class TableView{

        private $smarty;

        function __construct() {
            $this->smarty = new Smarty();
        }

        function showTable($budgets, $title, $listaMateriales){
            
            $this->smarty->assign('Title', $title);        
            $this->smarty->assign('Budgets', $budgets);
            $this->smarty->assign('Materiales', $listaMateriales);
            $this->smarty->assign('Edit', false);
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]))
                $this->smarty->assign('rol', $_SESSION["rol"]);
            else
                $this->smarty->assign('rol', 0);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }

        function showBudget($budget, $listaMateriales, $edit){
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budget', $budget);
            $this->smarty->assign('Materiales', $listaMateriales);
            $this->smarty->assign('Edit', $edit);
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]))
                $this->smarty->assign('rol', $_SESSION["rol"]);
            else
                $this->smarty->assign('rol', 0);
            $this->smarty->display('Templates/TableBudget.tpl');
        }

        function showMaterial($material){
            $this->smarty->assign('Title', 'Detalles de Material');
            $this->smarty->assign('Material',$material);
            $this->smarty->assign('Edit', true);
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]))
                $this->smarty->assign('rol', $_SESSION["rol"]);
            else
                $this->smarty->assign('rol', 0);
            $this->smarty->display('Templates/MaterialForm.tpl');
        }

        function showTableMateriales($materiales){
            $this->smarty->assign('Title', 'Lista de Materiales');
            $this->smarty->assign('Materiales',$materiales);
            $this->smarty->assign('Edit', false);
            if (session_status()!=2)
                session_start();
            if (isset($_SESSION["rol"]))
                $this->smarty->assign('rol', $_SESSION["rol"]);
            else
                $this->smarty->assign('rol', 0);
            $this->smarty->display('Templates/TableMateriales.tpl');
        }
    }
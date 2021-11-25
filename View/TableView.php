<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
require_once './Helpers/AuthHelper.php';
    
    class TableView{

        private $smarty;
        private $authHelper;

        function __construct() {
            $this->smarty = new Smarty();
            $this->authHelper = new AuthHelper();
        }

        function showTable($budgets, $title, $listaMateriales){
            
            $this->smarty->assign('Title', $title);        
            $this->smarty->assign('Budgets', $budgets);
            $this->smarty->assign('Materiales', $listaMateriales);
            $this->smarty->assign('Edit', false);
            $role = $this->authHelper->getRole();
            if (isset($role))
                $this->smarty->assign('role', $role);
            else
                $this->smarty->assign('role', 0);
            $this->smarty->display('Templates/TableBudgets.tpl');
        }

        function showBudget($budget, $listaComentarios, $listaMateriales, $edit, $message){
            $this->smarty->assign('Title', 'Lista de Presupuestos');        
            $this->smarty->assign('Budget', $budget);
            $this->smarty->assign('Comentarios', $listaComentarios);
       
            $this->smarty->assign('Materiales', $listaMateriales);
            $this->smarty->assign('Edit', $edit);
            $this->smarty->assign('Message', $message);
            $role = $this->authHelper->getRole();
            if (isset($role))
                $this->smarty->assign('role', $role);
            else
                $this->smarty->assign('role', 0);
            $this->smarty->display('Templates/TableBudget.tpl');
        }

        function showMaterial($material){
            $this->smarty->assign('Title', 'Detalles de Material');
            $this->smarty->assign('Material',$material);
            $this->smarty->assign('Edit', true);
            $role = $this->authHelper->getRole();
            if (isset($role))
                $this->smarty->assign('role', $role);
            else
                $this->smarty->assign('role', 0);
            $this->smarty->display('Templates/MaterialForm.tpl');
        }

        function showTableMateriales($materiales){
            $this->smarty->assign('Title', 'Lista de Materiales');
            $this->smarty->assign('Materiales',$materiales);
            $this->smarty->assign('Edit', false);
            $role = $this->authHelper->getRole();
            if (isset($role))
                $this->smarty->assign('role', $role);
            else
                $this->smarty->assign('role', 0);
            $this->smarty->display('Templates/TableMateriales.tpl');
        }

        function agregarComentario($id, $mensaje = ""){
            $this->smarty->assign('Title', 'Agregar Comentario');
            $this->smarty->assign('Id',$id);
            $this->smarty->assign('Mensaje',$mensaje);
            $this->smarty->display('Templates/CommentForm.tpl');
        }

        function mostrarComentarios($comentario){
            $this->smarty->assign('Title', 'Comentario');
            $this->smarty->assign('Cmoentario',$comentario);
            $this->smarty->display('Templates/Butget.tpl');
        }
    }
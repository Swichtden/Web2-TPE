<?php
require_once "./Model/MaterialesModel.php";
require_once "./Model/PresupuestoModel.php";
require_once "./View/TableView.php";
require_once "./Helpers/AuthHelper.php";

    class TableController{

        private $MaterialesModel;
        private $PresupuestoModel;
        private $TableView;
        private $AuthHelper;

        function __construct(){
                $this -> MaterialModel = new MaterialModel();
                $this -> PresupuestoModel = new PresupuestoModel();
                $this -> TableView = new TableView();
                $this -> AuthHelper = new authHelper();
        }

        function showBudgets(){

            $budgets = $this->PresupuestoModel->getBudgets();
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos", $listaMateriales);
        }

        function showBudget($id_cliente, $edit=false){
            $budget = $this->PresupuestoModel->getBudget($id_cliente);
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showBudget($budget, $listaMateriales, $edit);
        }

        function showMateriales(){
            $materiales=$this->MaterialModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

        function showMaterial($id_material){
            $materiales=$this->MaterialModel->getMaterial($id_material);
            $this->TableView->showMaterial($materiales);
        }

        function showPresupuestosXMaterial($material){
            $MaterialesxPresupuesto=$this->PresupuestoModel->getMaterialesxPresupuesto($material);
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showTable($MaterialesxPresupuesto, "Lista de clientes por material",$listaMateriales);
        }

        function createPresupuesto(){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->PresupuestoModel->insertPresupuesto($_POST['Cliente'], $_POST['Monto'], $_POST['Material']);
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
            $budgets = $this->PresupuestoModel->getBudgets();
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
        }
    
        function createMaterial(){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->MaterialModel->insertMaterial($_POST['Material'], $_POST['Precio'], $_POST['Descripcion']); 
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
            $materiales=$this->MaterialModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

        function deletePresupuesto($id){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->PresupuestoModel->deletePresupuesto($id);
                
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
            $budgets = $this->PresupuestoModel->getBudgets();
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
            }
        
        function deleteMaterial($id){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->MaterialModel->deleteMaterial($id);
            }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
                $materiales=$this->MaterialModel->getMateriales();
                $this->TableView->showTableMateriales($materiales);
        }
        function updatePresupuesto(){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->PresupuestoModel->updatePresupuesto($_POST['id_cliente'], $_POST['Cliente'], $_POST['Monto'], $_POST['Material']);
            }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
            $budgets = $this->PresupuestoModel->getBudgets();
            $listaMateriales = $this->MaterialModel->getMateriales();
            $this->TableView->showTable($budgets, "Lista de Presupuestos",$listaMateriales);
        }
        
        function updateMaterial(){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->MaterialModel->updateMaterial($_POST['id_material'],$_POST['Material'], $_POST['Precio'], $_POST['Descripcion']);
            }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
            $materiales = $this->MaterialModel->getMateriales();
            $this->TableView->showTableMateriales($materiales);
        }

    }
<?php
require_once "./Model/MaterialesModel.php";
require_once "./Model/PresupuestoModel.php";
require_once "./Helpers/AuthHelper.php";
require_once "./Model/ComentarioModel.php";
require_once "./View/ApiView.php";

class ApiTaskController{

    private $MaterialModel;
    private $PresupuestoModel;
    private $view;

    function __construct(){
        $this->MaterialModel = new MaterialModel();
        $this->PresupuestoModel = new PresupuestoModel();
        $this->ComentarioModel = new ComentarioModel();
        $this->view = new ApiView();
    }


    public function getdata(){
        return json_decode($this->data); 
        }

    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

    function coment($params){

        //$body= $this->getData(); //no se si anda
        $body= $this->getBody();

        $puntaje= $body->puntaje;
        $comentario= $body->detalle;
        $idUser= $body->idUser;
        $idCliente= $params[':ID'];
        if ($this->AuthHelper->getRole()==1){   //1 =usuario 
                $id = $this->model->insertTask($body->puntaje, $body->detalle, $body->idUser, $body->$params[':ID']);
                if ($id){
                        $this->view->response("Se agregado el comentario", 200);
                    }
                    else{
                        $this->view->response("No se puedo agregar el comentario", 500);
                    }
        }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
        
    }

    function deleteComent($params){
        $id = $params[':ID'];
        $comentario = $this->modelComentarios->getById($id);
        if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
            if ($comentario) {
                $this->modelComentarios->delete($id);
                $this->view->response("El comentario con id {$id} se eliminó correctamente", 200);
            }
            else{
                $this->view->response("No existe comentario para eliminar con id {$id}", 404);
            } 
        }else{
            echo("Usted no tiene permisos para realizar esta accion!");
        }
    }


    
}
?>
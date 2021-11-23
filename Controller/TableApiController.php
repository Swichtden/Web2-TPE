<?php
require_once "./Model/MaterialesModel.php";
require_once "./Model/PresupuestoModel.php";
require_once "./Model/ComentarioModel.php";
require_once "./View/ApiView.php";

class ApiTaskController{

    private $MaterialModel;
    private $PresupuestoModel;
    private $view;

    function __construct(){
        $this->MaterialModel = new MaterialModel();
        $this->PresupuestoModel = new PresupuestoModel();
        $this->view = new ApiView();
    }


    public function getdata(){
        return json_decode($this->data); 
        }

    function coment($params){

        $body= $this->getData();


        $comentario= $body->comentario;
        $puntaje= $body->puntaje;
        $idUser= $body->idUser;
        $idPresupuesto= $params[':ID'];

        $resultado= $this->modelComentarios->newCommentary($comentario, $puntaje, $idPresupuesto, $idUser);
        header("Location: " . BASE_URL . 'comPresupuesto/' . $idPresupuesto); //verificar que comPresupuesto/ ande bien

        if ($resultado){
            $this->view->response("Se agregado el comentario", 200);
        }
        else{
            $this->view->response("No se puedo agregar el comentario", 500);
        }
    }

    public function deleteComent($params){
        $id = $params[':ID'];
        $comentario = $this->modelComentarios->getById($id);

        if ($comentario) {
            $this->modelComentarios->delete($id);
            $this->view->response("El comentario con id {$id} se eliminó correctamente", 200);
        }
        else{
            $this->view->response("No existe comentario para eliminar con id {$id}", 404);
        }
    }
}
?>
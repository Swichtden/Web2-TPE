<?php
require_once "./Helpers/AuthHelper.php";
require_once "./Model/ComentariosModel.php";
require_once "./View/ApiView.php";
require_once "./Controller/TableController.php";

class CommentsApiController{

    private $AuthHelper;
    private $ComentarioModel;
    private $view;

    function __construct(){
       
        $this->AuthHelper = new AuthHelper();
        $this->ComentarioModel = new ComentarioModel();
        $this->view = new ApiView();
    }

    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

    function getComments($data){
        $comentarios = $this->ComentarioModel->getComments($data[':ID_Budget']);
        $this->view->response($comentarios,200);
    }

    function AddComment(){
        $data = $this->getBody();
        $idUser = $this->AuthHelper->getUserId();
        if ($this->AuthHelper->getRole()>=1){   //1 =usuario 
                 $IdComment= $this->ComentarioModel->newComment($data->Puntaje, $data->Comentario,  $data->idBudget, $idUser);
                 if ($IdComment != 0){
                        $this->view->response("Se agregado el comentario con el id=$IdComment", 200); 
                    }
                else{
                    $this->view->response("No se puedo agregar el comentario", 500);
                }
        }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
    }

    function deleteComment($params=null){
        $id = $params[':ID'];
        $comentario = $this->ComentarioModel->getCommentById($id);
        if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
            if ($comentario) {
                $this->ComentarioModel->deleteComment($id);
                $this->view->response("El comentario con id {$id} se elimino correctamente", 200);
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
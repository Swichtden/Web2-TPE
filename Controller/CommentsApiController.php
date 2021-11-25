<?php
require_once "./Helpers/AuthHelper.php";
require_once "./Model/ComentariosModel.php";
require_once "./View/ApiView.php";
require_once "./Controller/TableController.php";

class CommentsApiController{

    private $AuthHelper;
    private $ComentarioModel;
    private $view;
    private $TableController;

    function __construct(){
       
        $this->AuthHelper = new AuthHelper();
        $this->ComentarioModel = new ComentarioModel();
        $this->view = new ApiView();
        $this->TableController = new TableController();

        $this->data= file_get_contents("php://input");
    }

    function getData(){
        return json_decode($this->data);
    }

   

    function AddComentary($params=null){
        $puntaje= $_POST['Puntaje'];
        $comentario= $_POST['Comentario'];
        $idUser = $this->AuthHelper->getUserId();
        $idPresupuesto = $params[':ID'];
        if ($this->AuthHelper->getRole()>=1){   //1 =usuario 
                 $insertCommet= $this->ComentarioModel->newCommentary($puntaje, $comentario,  $idPresupuesto, $idUser);
                
                 if ($insertCommet){
                        $this->view->response("Se agregado el comentario", 200);
                    }
                     else{
                      $this->view->response("No se puedo agregar el comentario", 500);
                    }
        }else{
                echo("Usted no tiene permisos para realizar esta accion!");
            }
        
    }

    function deleteComentary($params=null){
        $id = $params[':ID'];
        $comentario = $this->modelComentarios->getById($id);
        if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
            if ($comentario) {
                $this->modelComentarios->deleteComentario($id);
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
<?php

    class comentarioModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function newComment($puntaje, $comentario, $id_presupuesto, $id_user){
            $sentencia = $this->db->prepare("INSERT INTO comentarios(puntaje, detalle, FK_id_cliente, FK_id_user)
                                            VALUE (?, ?, ?, ?)");
            $sentencia->execute(array($puntaje, $comentario, $id_presupuesto, $id_user));
            return $this->db->lastInsertId();
        }

         function getCommentById($id){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
            $comentarios= $sentencia->fetch(PDO::FETCH_OBJ);
    
            return $comentarios;
        }

        function getComments($idBudget){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE FK_id_cliente=?");
            $sentencia->execute([$idBudget]);
            $comentarios= $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }

        function getCantRows($idBudget){
            $sentencia= $this->db->prepare("SELECT COUNT(*) AS 'cantTotal' FROM comentarios WHERE FK_id_cliente=?");
            $sentencia->execute([$idBudget]);
            $cantRow= $sentencia->fetch(PDO::FETCH_OBJ);
            return $cantRow->cantTotal;
        }

        function getCommentsByPage($idBudget, $page, $cantRows){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE FK_id_cliente=? LIMIT ?,?"); //Devuelve 5 comentarios por pagina
            $sentencia->bindParam(1, $idBudget, PDO::PARAM_INT);
            if ($page <= 0){
                $page = 1;
            }
            $page = (($page-1)*5);
            $sentencia->bindParam(2, $page, PDO::PARAM_INT);
            $sentencia->bindParam(3, $cantRows, PDO::PARAM_INT);
            $sentencia->execute(); //---------------------------------->asignamos los parametros de esta forma porque sino los pasaba como string
            $comentarios= $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }
        
        function deleteComment($id){
            $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
        }
    }
?>
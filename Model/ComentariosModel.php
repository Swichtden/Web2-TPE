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
            $sentencia->execute((array)$idBudget);
            $comentarios= $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }
        
        function deleteComment($id){
            $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
        }
    }
?>
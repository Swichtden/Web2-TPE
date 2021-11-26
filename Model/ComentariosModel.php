<?php

    class comentarioModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function newCommentary($puntaje, $comentario, $id_presupuesto, $id_user){
            $sentencia = $this->db->prepare("INSERT INTO comentarios(puntaje, detalle, FK_id_cliente, FK_id_user)
                                            VALUE (?, ?, ?, ?)");
            $comentario= $sentencia->execute(array($puntaje, $comentario, $id_presupuesto, $id_user));
            return $comentario;
        }

        function getComentary($id){

            $sentencia = $this->db->prepare("SELECT comentarios.puntaje, comentarios.detalle,
                                            comentarios.FK_id_cliente, comentarios.FK_id_user
                                            FROM comentarios JOIN usuario ON comentarios.FK_id_user=usuario.id_usuario
                                            WHERE comentarios.FK_id_cliente= ?");
            $sentencia->execute([$id]);
            $comentario = $sentencia->fetchAll(PDO::FETCH_OBJ); 
            return $comentario;
           
        }

         function getById($id){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
            $comentarios= $sentencia->fetch(PDO::FETCH_OBJ);
    
            return $comentarios;
        }

        function getComments($id){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE FK_id_cliente=?");
            $sentencia->execute((array)$id);
            $comentarios= $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }
        
        function deleteComentario($id){
            $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
        }
    }
?>
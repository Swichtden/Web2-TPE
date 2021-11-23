<?php

    class comentarioModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function newCommentary($comentario, $puntaje, $id_presupuesto, $id_user){
        $sentencia = $this->db->prepare("INSERT INTO comentarios(tcomentario, puntuacion, id_presupuesto_fk, id_user_fk) VALUE (?, ?, ?, ?)");
        $comentario= $sentencia->execute([$comentario, $puntaje, $id_presupuesto, $id_user]);
        return $comentario;
        }

        function getComentsBook($id){
            $sentencia = $this->db->prepare("SELECT comentarios.id_comentario, comentarios.texto, comentarios.puntuacion, 
                                            comentarios.id_libro_fk, comentarios.id_usuario_fk, usuario.nombre, usuario.apellido 
                                            FROM comentarios JOIN usuario ON comentarios.id_usuario_fk=usuario.id_usuario
                                            WHERE comentarios.id_libro_fk= ?");
            $sentencia->execute([$id]);
            $comentario = $sentencia->fetchAll(PDO::FETCH_OBJ); 
            return $comentario;
        }

        function getById($id){
            $sentencia= $this->db->prepare("SELECT * FROM comentarios WHERE id_usuario_fk = ?");
            $sentencia->execute([$id]);
            $comentarios= $sentencia->fetch(PDO::FETCH_OBJ);
            return $comentarios;
        }

         function deleteComentario($id){
            $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
            $sentencia->execute([$id]);
        }
    }
?>
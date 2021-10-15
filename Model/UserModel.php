<?php
class UserModel{

    private $db;
    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
    }

    function getUser($email){
        $sentencia = $this->db->prepare('SELECT usuarios.email, usuarios.password, roles.nivel_acceso 
                                         FROM usuarios 
                                         JOIN roles ON usuarios.FK_role_id = roles.id_rol
                                         WHERE usuarios.email = ?');
        $sentencia->execute([$email]);
        $usuario=$sentencia->fetch(PDO::FETCH_OBJ);
        
        return $usuario;    
    }


}



?>
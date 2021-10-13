<?php
class UserModel{

    private $db;
    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=usuarios;charset=utf8', 'root', '');
    }

    function getUser($email){
        $sentencia = $this->db->prepare('SELECT * FROM usaurios WHERE email = ?');
        $sentencia->execute([$email]);
        $usuario=$sentencia->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }


}



?>
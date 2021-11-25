<?php
class UserModel{

    private $db;
    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
    }

    function getUser($email){
        $sentencia = $this->db->prepare('SELECT usuarios.id_user, usuarios.email, usuarios.password, roles.nivel_acceso 
                                         FROM usuarios 
                                         JOIN roles ON usuarios.FK_role_id = roles.id_rol
                                         WHERE usuarios.email = ?');
        $sentencia->execute([$email]);
        $usuario=$sentencia->fetch(PDO::FETCH_OBJ);
        
        return $usuario;    
    }

    function checkUser($email){
        $sentencia = $this->db->prepare('SELECT email FROM usuarios WHERE email = ?');
        $sentencia->execute([$email]);
        $usuario=$sentencia->fetch(PDO::FETCH_OBJ);
        if ($usuario) {
            return true;
        } else {
            return false;
        }
    }

    function AddUser($mail, $password){
        $sentencia=$this->db->prepare("INSERT INTO usuarios(email, password, FK_role_id) VALUES(?,?,?)");
        $sentencia->execute(array($mail, $password, 1)); // 1 es el id del rol de usuario
    }

    function getUsers(){
        $sentencia = $this->db->prepare('SELECT usuarios.id_user, usuarios.email, roles.id_rol, roles.nombre_rol
                                         FROM usuarios JOIN roles ON(usuarios.FK_role_id=roles.id_rol)');
        $sentencia->execute();
        $usuarios=$sentencia->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;    
        
    }
    
    function updateUser($id, $role){
        $sentencia=$this->db->prepare("UPDATE usuarios SET FK_role_id=? WHERE id_user=?");
        $sentencia  ->execute(array($role,$id));
    }

    function deleteUser($id){
        $sentencia=$this->db->prepare("DELETE FROM usuarios WHERE id_user=?");
        $sentencia->execute([$id]);
    }
    

}
?>
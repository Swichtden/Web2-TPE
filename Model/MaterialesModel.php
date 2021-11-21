<?php

    class MaterialModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function getMaterialNombre(){
            $sentencia=$this->db->prepare("SELECT id_material,nombre_material FROM materiales");
            $sentencia->execute();
            $materiales=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $materiales;
        }

        function getMateriales(){
            $sentencia=$this->db->prepare(" SELECT materiales.id_material,materiales.nombre_material,materiales.precio_material,
                                                        materiales.descripcion_material
                                            FROM materiales");
            $sentencia->execute();
            $materiales=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $materiales;
        }
        
        function getMaterial($id_material){
            $sentencia=$this->db->prepare("SELECT materiales.id_material, materiales.nombre_material, materiales.precio_material, materiales.descripcion_material
                                            FROM materiales
                                            WHERE materiales.id_material=?");
            $sentencia->execute((array)$id_material);
            $material=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $material;
        }

        function insertMaterial($nombre, $precio, $descripcion){
            $sentencia = $this->db->prepare("INSERT INTO materiales( nombre_material,precio_material,descripcion_material)
                                             VALUES(?, ?, ?)");
            $sentencia->execute(array($nombre, $precio, $descripcion));
        }

        function deleteMaterial($id){
            try{
            $sentencia = $this->db->prepare("DELETE FROM materiales WHERE id_material=?");
            $sentencia->execute(array($id));
            } catch(Throwable $e){
                if ($e->errorInfo[0]=="23000")
                    echo("No se puede eliminar una categoria que esta siendo usada");
                else
                    var_dump($e);
            }
        }

        function updateMaterial($id, $nombre, $precio, $descripcion){
            $sentencia = $this->db->prepare("UPDATE materiales SET nombre_material=?, precio_material=?, descripcion_material=? 
                                             WHERE id_material=?");
            $sentencia->execute(array($nombre, $precio, $descripcion, $id));
        }
    
    }
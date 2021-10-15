<?php

    class TableModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function getBudgets(){
            $sentencia=$this->db->prepare("SELECT presupuestos.id_cliente, presupuestos.nombre_cliente, materiales.nombre_material
                                            FROM presupuestos 
                                            JOIN materiales ON presupuestos.FK_id_material=materiales.id_material
                                            ");
            $sentencia->execute();
            $presupuesto = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $presupuesto;
        }

        function getBudget($id_cliente){
            $sentencia=$this->db->prepare("SELECT presupuestos.id_cliente, presupuestos.nombre_cliente, presupuestos.monto, materiales.nombre_material 
                                            FROM presupuestos
                                            JOIN materiales ON presupuestos.FK_id_material=materiales.id_material
                                            WHERE presupuestos.id_cliente=?");
            $sentencia->execute((array)$id_cliente);
            $presupuesto=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $presupuesto;
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

        function getMaterialesxPresupuesto($material){
            $sentencia=$this->db->prepare("SELECT presupuestos.id_cliente, presupuestos.nombre_cliente, materiales.nombre_material
                                            FROM presupuestos 
                                            JOIN materiales ON presupuestos.FK_id_material=materiales.id_material
                                            where materiales.id_material=(
                                                select m2.id_material
                                                from materiales m2
                                                where m2.id_material=?
                                            )");
            $sentencia->execute((array)$material);  
            $materiales=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $materiales;
        }
          

        function insertPresupuesto($nombre, $monto, $material){
            $sentencia = $this->db->prepare("INSERT INTO presupuestos( nombre_cliente, monto, FK_id_material)
                                             VALUES(?, ?, ?)");
            $sentencia->execute(array($nombre, $monto, $material));
        }
        
        function insertMaterial($nombre, $precio, $descripcion){
            $sentencia = $this->db->prepare("INSERT INTO materiales( nombre_material,precio_material,descripcion_material)
                                             VALUES(?, ?, ?)");
            $sentencia->execute(array($nombre, $precio, $descripcion));
        }

        function deletePresupuesto($id){
            $sentencia = $this->db->prepare("DELETE FROM presupuestos WHERE id_cliente=?");
            $sentencia->execute(array($id));
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

        function updatePresupuesto($id, $nombre, $monto, $material){
            $sentencia = $this->db->prepare("UPDATE presupuestos SET nombre_cliente=?, monto=?, FK_id_material=? 
                                             WHERE id_cliente=?");
            $sentencia->execute(array($nombre, $monto, $material, $id));
        }
        
        function updateMaterial($id, $nombre, $precio, $descripcion){
            $sentencia = $this->db->prepare("UPDATE materiales SET nombre_material=?, precio_material=?, descripcion_material=? 
                                             WHERE id_material=?");
            $sentencia->execute(array($nombre, $precio, $descripcion, $id));
        }

    }
<?php

    class TableModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function getBudgets(){
           // $sentencia = $this->db->prepare( "SELECT id_cliente,nombre_cliente,FK_id_material FROM presupuestos");
            $sentencia=$this->db->prepare("SELECT presupuestos.id_cliente, presupuestos.nombre_cliente, materiales.nombre_material
                                            FROM presupuestos 
                                            JOIN materiales ON presupuestos.FK_id_material=materiales.id_material
                                            ");
            $sentencia->execute();
            $presupuesto = $sentencia->fetchAll(PDO::FETCH_OBJ);
            /* $materiales = $this->getMaterialNombre(); */
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

        function getMaterialesLista(){
            $sentencia=$this->db->prepare(" SELECT materiales.id_material,materiales.nombre_material,materiales.precio_material,
                                                        materiales.descripcion_material
                                            FROM materiales");
            $sentencia->execute();
            $materiales=$sentencia->fetchAll(PDO::FETCH_OBJ);
            return $materiales;
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
            $sentencia = $this->db->prepare("INSERT INTO material( nombre_material,precio_material, descripcion)
                                             VALUES(?, ?, ?)");
            $sentencia->execute(array($nombre, $precio, $descripcion));
        }

        function deletePresupuesto($id){
            $sentencia = $this->db->prepare("DELETE FROM presupuestos WHERE id_cliente=?");
            $sentencia->execute(array($id));
        }

        function deleteMaterial($id){
            $sentencia = $this->db->prepare("DELETE FROM materiales WHERE id_material=?");
            $sentencia->execute(array($id));
        }

        function updatePresupuesto($id, $nombre, $monto, $material){
            $sentencia=$this->db->prepare(" SELECT materiales.id_material FROM materiales WHERE nombre_material=?"); //el usuario ingresa el nombre del material y aca lo macheo con su respectivo id
            $sentencia->execute((array)$material);
            $id_material=$sentencia->fetchAll(PDO::FETCH_OBJ)[0]->id_material; //tomo el string del arreglo que me devuleve
            $sentencia = $this->db->prepare("UPDATE presupuestos SET nombre_cliente=?, monto=?, FK_id_material=? 
                                             WHERE id_cliente=?");
            $sentencia->execute(array($nombre, $monto, $id_material, $id));
        }
        
        function updateMaterial($id, $nombre, $precio, $descripcion){
            $sentencia = $this->db->prepare("UPDATE presupuestos SET nombre_material=?, precio_material=?, descripcion=? 
                                             WHERE id_material=?");
            $sentencia->execute(array($nombre, $precio, $descripcion, $id));
        }

    }
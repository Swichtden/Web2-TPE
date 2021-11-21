<?php

    class PresupuestoModel{

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

        function deletePresupuesto($id){
            $sentencia = $this->db->prepare("DELETE FROM presupuestos WHERE id_cliente=?");
            $sentencia->execute(array($id));
        }

        function updatePresupuesto($id, $nombre, $monto, $material){
            $sentencia = $this->db->prepare("UPDATE presupuestos SET nombre_cliente=?, monto=?, FK_id_material=? 
                                             WHERE id_cliente=?");
            $sentencia->execute(array($nombre, $monto, $material, $id));
        }

    }
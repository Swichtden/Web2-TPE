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
            $sentencia=$this->db->prepare("SELECT presupuestos.nombre_cliente,presupuestos.monto,materiales.nombre_material 
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
          
    }
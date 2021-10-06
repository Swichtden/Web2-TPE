<?php

    class TableModel{

        private $db;
        function __construct(){
           
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_presupuestos_impresiones;charset=utf8', 'root', '');
        }

        function getBudgets(){
            $sentencia = $this->db->prepare( "select * from presupuestos");
            $sentencia->execute();
            $presupuesto = $sentencia->fetchAll(PDO::FETCH_OBJ);
            var_dump ($presupuesto);
            return $presupuesto;
        }
    }
<?php


    class authHelper{

        function __construct(){}

        function UserIsLogged(){
            session_start();
            if(!isset($_SESSION["email"])){
                header("Location: ".BASE_URL."login");
            }
        }

        function getRole(){
            $this->UserIsLogged();
            if (isset($_SESSION["role"])){
                return $_SESSION["role"]; /* Esto devuelve un int que representa el nivel de acceso */
            }
            return 0;
        }
    }
?>
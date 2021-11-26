<?php


    class authHelper{

        function __construct(){}

        function UserIsLogged($redirect = true){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(!isset($_SESSION["email"])){
                if ($redirect){
                    header("Location: ".BASE_URL."login");
                }
                else{
                    return false;
                }
            }
        }

        function getRole(){
            $this->UserIsLogged(false);
            if (isset($_SESSION["role"])){
                return $_SESSION["role"]; /* Esto devuelve un int que representa el nivel de acceso */
            }
            return 0;
        }

        function getUserId(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(!isset($_SESSION)){
                session_start();
            }
            if (isset($_SESSION["id"])){
                return $_SESSION["id"]; 
            }else{
                return "";
            }
        }
    }
?>
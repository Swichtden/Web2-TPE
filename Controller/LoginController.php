<?php
    require_once "./Model/UserModel.php";
    require_once "./View/LoginView.php";

    class LoginController{

        private $model;
        private $view;

        function __construct(){
            $this->model = new UserModel();
            $this->view = new LoginView();
        }
        
        function logout(){
            session_start();
            session_destroy();
            $this->view->showLogin("Te Deslogueaste");
        }
    
        function login(){
            $this->view->showLogin();
        }
    
        
    

    }




?>
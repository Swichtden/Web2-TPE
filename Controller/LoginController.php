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
        
    

    }




?>
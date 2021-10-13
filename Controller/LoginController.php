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
    
        function verifyLogin(){
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
         
                
                $user = $this->model->getUser($email);
         
                
                if ($user && password_verify($password, $user->password)) {
    
                    session_start();
                    $_SESSION["email"] = $email;
                    
                    $this->view->showHome();
                } else {
                    $this->view->showLogin("Acceso denegado");
                }
            }
        }
    
    

    }




?>
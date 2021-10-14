<?php
    require_once "./Model/UserModel.php";
    require_once "./View/LoginView.php";
    

    class LoginController{

        private $UserModel;
        private $LoginView;

        function __construct(){
            $this->UserModel = new UserModel();
            $this->LoginView = new LoginView();
        }
        
        function logout(){
            session_start();
            session_destroy();
            $this->LoginView->showLogin("Te Deslogueaste");
        }
    
        function login(){
            $this->LoginView->showLogin();
        }
    
        function verifyLogin(){
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
         
                $user = $this->UserModel->getUser($email);
                if ($user && password_verify($password, $user->password)) {
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["rol"] = $user->nivel_acceso;
                    $this->LoginView->showHome();
                } else {
                    $this->LoginView->showLogin("Acceso denegado");
                }
            }
        }
    
    

    }




?>
<?php
    require_once "./Model/UserModel.php";
    require_once "./View/LoginView.php";
    require_once "./Helpers/AuthHelper.php";
    

    class LoginController{

        private $UserModel;
        private $LoginView;

        function __construct(){
            $this->UserModel = new UserModel();
            $this->LoginView = new LoginView();
            $this->AuthHelper = new AuthHelper();
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
                    $_SESSION["role"] = $user->nivel_acceso;
                    $this->LoginView->showHome();
                } else {
                    $this->LoginView->showLogin("Acceso denegado");
                }
            }
        }
    
        // function showSignIn(){
        //     $this->LoginView->showSignIn();
        // }

        function signIn(){
            
            if (!isset($_POST['email'])){
                $this->LoginView->showSignIn();
            }
            else{
                $email=$_POST['email'];
                $password= password_hash( $_POST['password'] , PASSWORD_DEFAULT);
            
                if ($this->AuthHelper->UserIsLogged(false)){
                    $this->LoginView->showSignIn("Usted ya esta logeado");
                } else {
                    $userExists=$this->UserModel->checkUser($email);
                    if(!$userExists){
                        $this->UserModel->AddUser($email, $password);
                        $this->verifyLogin();
                    } 
                    else {
                        $this->LoginView->showSignIn("El usuario ya existe");
                    }
                }
            }
        }
    
        function showUsers(){
            if ($this->AuthHelper->getRole()==2){
                $users = $this->UserModel->getUsers();
                $this->LoginView->showUsers($users);
            }else{
                echo("Usted no tiene permisos para ver esta informacion!");
            }
        }

        function updateRoleUser($id){
            $role=$_POST['FK_rol_id'];
           
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->UserModel->updateUser($id, $role);
                $users = $this->UserModel->getUsers();
                $this->LoginView->showUsers($users,"se cambio el rol del usuario");
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
        }


        function deleteUser($id){
            if ($this->AuthHelper->getRole()==2){   //2 =usuario admin
                $this->UserModel->deleteUser($id);
                $users = $this->UserModel->getUsers();
                $this->LoginView->showUsers($users,"usuario eliminado");
            }else{
                    echo("Usted no tiene permisos para realizar esta accion!");
                }
        }
    }
?>
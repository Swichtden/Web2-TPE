<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

    class LoginView{

            private $smarty;
    
        function __construct(){
            $this->smarty= new Smarty();
        }

        function showLogin($error=""){
            $this->smarty->assign('Title', 'Login');
            $this->smarty->assign('Error', $error);
            $this->smarty->display('Templates/Login.tpl');
        }

        function showHome(){
            header("Location: ".BASE_URL."home");
        }

        function showSignIn($error=""){
            $this->smarty->assign('Title', 'SingIn');
            $this->smarty->assign('Error', $error);
            $this->smarty->display('Templates/SignIn.tpl');
        }
        
        function showUsers($users, $message=""){
            $this->smarty->assign('Title', 'Users');
            $this->smarty->assign('Users', $users);
            $this->smarty->assign('Message', $message);
            $this->smarty->display('Templates/TableUsers.tpl');
        }
    }
?>
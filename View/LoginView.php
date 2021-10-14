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
    }


?>
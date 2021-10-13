<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

    class LoginView{

            private $smarty;
    
        function __construct(){
            $this->smarty= new Smarty();
        }

        function showLogin(){
            $this->smarty->assing('Title','Login');
            $this->smarty->display('Templetes/Login.tpl');
        }

        
    }


?>
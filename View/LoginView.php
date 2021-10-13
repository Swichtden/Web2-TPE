<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

    class LoginView{

            private $smarty;
    
        function __construct(){
            $this->smarty= new Smarty();
        }

        function showLogin(){
            $this->smarty->assing('Title','Logearse');
            $this->smarty->assing('',);
            $this->smarty->display('Templetes/login.tpl');
        }

        
    }


?>
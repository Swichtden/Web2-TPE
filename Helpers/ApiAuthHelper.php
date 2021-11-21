<?php

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AuthApiHelper{
    private $key;

    function __construct(){
        $this->key = "";
    }

    function getBasic(){
        $header = $this->getHeader();
        if(strpos($header,"Basic ")===0){
            $usrpass = explode(" ",$header)[1];
            $usrpass = base64_decode($usrpass);
            $usrpass = explode(":", $usrpass);
            if(count($usrpass)==2){
                $user = $usrpass[0];
                $pass = $usrpass[1];
                return array(
                    "user" => $user,
                    "pass" => $pass
                );
            }
        }
        return null;
    }

    function getUser(){
        $header = $this->getHeader();
        if(strpos($header,"Bearer ")===0){
            $token = explode(" ", $header)[1];
            $parts = explode(".", $token);
            if(count($parts)===3){
                $header = $parts[0];
                $payload = $parts[1];
                $signature = $parts[2];
                $new_signature = hash_hmac('SHA256', "$header.$payload", $this->key, true);
                $new_signature = base64url_encode($new_signature);
                if($signature == $new_signature){
                    $payload = base64_decode($payload);
                    $payload = json_decode($payload);
                    if(true){
                        return $payload;
                    }
                }
            }
        }
        return null;
    }

    public function createToken($user){
        $header = array(
            'alg' => 'HS256',
            "typ" => 'JWT'
        );
        $payload = array(
            "sub" => 1,
            "name" => $user["user"],
            "rol" => ["admin", "other"]
        );
        $header = base64url_encode(json_encode($header));
        $payload = base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$header.$payload", $this->key, true);
        $signature = base64url_encode($signature);
        return "$header.$payload.$signature";
    }

    function getHeader(){
        if(isset($_SERVER["REDIRECT_HTTP_AUTHORIZATION"])){
            return $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];
        }if(isset($_SERVER["HTTP_AUTHORIZATION"])){
            return $_SERVER["HTTP_AUTHORIZATION"];
        }
        return null;
    }

}

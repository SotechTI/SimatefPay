<?php
    require_once 'Config.php';
class Captcha {
    
    public function getCaptcha($response){
        $Resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$response}");
        $Retorno = json_decode($Resposta);
        return $Retorno;
    }
}

    

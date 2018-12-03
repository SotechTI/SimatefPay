<?php
    require_once '../classes/Captcha.php';
    //Classe de Login
    require_once '../classes/Login.php';
    
    //Dados eniados via Post
    $usuario = $_POST['Nusuario'];
    $senha = $_POST['Nsenha'];
    
    //retorna a resposta do captcha
    $ObjCaptcha = new Captcha();
    $Retorno = $ObjCaptcha->getCaptcha($_POST['g-recaptcha-response']);
    
    //Verifica osdados vieram nulos
    if (($usuario == null) || ($senha == null)){
        echo "<script> alert('Preencha Todos os Campos!'); location.href='../index.php';</script>";
    }

    if($Retorno->success == true && $Retorno->score > 0.5){
         //Tira o hash sha1 da senha
        $hashSenha = sha1($senha);
        $dadosLogin = array('usuario' => $usuario, 'senha' => $hashSenha);
        $user = new Login($dadosLogin);
        if ($user->realizarLogin()){
            header("Location: ../interface/index.php");
        }else{
            echo "<script> alert('Usuario ou Senha Inválidos!'); location.href='../index.php';</script>";
        }  
    }else{
        echo "<script> alert('Suspeita de Invasão. Reinicie o navegador e tenta novamente!'); location.href='../index.php';</script>";
    }
<?php
    require_once '../classes/Login.php';
    session_start(); // iniciando a sessão
    if(!isset ($_SESSION['usuario']) == true)
    {
    unset($_SESSION['usuario']);
    header('location:../index.php');
    }
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sotech Pagamentos Eletrônicos">
   
    <title>Simatef Pay</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 bg-light">
            <form class="form-signin" action="" method="post" name="cadastrarSenha">
                <h2 class="form-signin-heading text-center">Simatef Pay</h2>
                <div class="form-group">
                    <small id="IinfoSenha" class="form-text text-danger">*A senha deverá conter 8 dígitos; Pelo menos uma letra maiuscula; uma minuscula, um caractere especial. Ex: (@,#,$,%,&,*).</small>
                </div>
                <div class="form-group">
                    <input name="NSenha" type="password" id="inputSenha" class="form-control" placeholder="Digite sua Senha" required autofocus maxlength="8">
                </div>
                <div class="form-group">
                    <input name="NConfirmaSenha" type="password" id="inputConfirmaSenha" class="form-control" placeholder="Digite novamente Sua Senha" required>
                </div>
                <!--<div class="checkbox">
                  <label>
                    <input type="checkbox" value="remember-me"> Remember me
                  </label>
                </div>-->
                <button type="button" class="btn btn-primary" accesskey="#13" onClick="validarForm()">Cadastrar</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->
    <script> 
        function validarForm(){
            
            
        }
    </script>
  </body>
</html>
 
    


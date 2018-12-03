<?PHP
    require_once 'classes/Config.php';
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
    <link href="interface/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Custom styles for this template -->
    <link href="interface/css/login.css" rel="stylesheet" type="text/css"/>
    </script> 
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="form-signin" onsubmit="return validarForm();" method="post" name="login" action="negocio/controlllerForm.php">
                <h2 class="form-signin-heading text-center text-white">SimaTEF PAY</h2>
                <input name="Nusuario" onKeyPress="MascaraCNPJ(login.Nusuario);" type="text" id="inputUsuario" class="form-control" placeholder="Usuário" required autofocus maxlength="18">
                <br>
                <input name="Nsenha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                <!--<div class="checkbox">
                  <label>
                    <input type="checkbox" value="remember-me"> Remember me
                  </label>
                </div>-->
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <div class="container">
                    <span class="text-danger" id="g-recaptcha-error"></span>
                </div>
                <input type="submit" class="btn btn-primary" id="btnSubmit" value="Logar">
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->
    <script src="interface/js/Mascaras.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
    <script src="interface/js/Captcha.js" type="text/javascript"></script>
    <script> 
        function validarForm(){
            cnpj = document.getElementById('inputUsuario').value;
            senha = document.getElementById('inputPassword').value;
           
            if((cnpj === null) || (senha === null)){
                alert('Preencha todos os campos');
                return false;
            }else if(!validarCNPJ(cnpj)){
                alert('CNPJ Inválido!');
                return false;
            }
            document.login.submit();
        }
    </script>
    
    <script>
        var input = document.getElementById("inputUsuario");
        input.addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("btnSubmit").click();
            }
        });
    </script>
    <script>
        var input = document.getElementById("inputPassword");
        input.addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("btnSubmit").click();
            }
        });
    </script>
  </body>
</html>
 
    


<?php
    require_once '../classes/Estabelecimento.php';
    session_start();
    if((!isset ($_SESSION['usuario']) == true)){
    unset($_SESSION['usuario']);
    header('location:../index.php');
    }
    $estabelecimento = new Estabelecimento($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>SimatefPay - Gerar Link</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="css/venda.css">
    </head>
    <body>
        <main class="page payment-page">
            <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                </div>
                <form name="checkout" method="post" action="../negocio/enviarLink.php">
                    <div class="products">
                        <div class="container">
                            <div class="row mb-3">
                                <div>
                                    <img class="img-fluid" src="img/simatefpay.png">
                                </div>
                            </div>
                            <div class="row my-2">
                            <div class="col-md-8">
                                <h4 class="title">Bem vindo, <?php echo $estabelecimento->getNome(); ?>!</h4>
                            </div>
                            <div class="col-md-2 offset-md-1">
                                <div class="dropdown">
                                  <button class="btn btn-primary dropdown-toggle dropdown-menu-right mb-3" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#exampleModalCenter">Status das vendas</button>
                                    <button class="dropdown-item" type="button">Log out</button>
                                </div>
                                </div>
                            </div>
                        </div>
                            
                            <div class="item">
                            <span class="price"></span>
                            <p class="item-name">Valor da venda</p>
                            <div class="row">
                                <div class="col-md-4 input-group mb-3 my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="text" id="iValor" name="nValor" class="form-control" onKeyUp="moeda(this);" required>
                                </div>
                                <div class="col-md-8 input-group mb-3 my-2">
                                    <select class="form-control" name="nFormaPag" id="iFormaPag" onchange="formaParcelada(this.value)" required>
                                        <option value="">Selecione</option>
                                        <option value="À Vista">À Vista</option>
                                        <option value="Parcelada">Parcelada</option>
                                    </select> 
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" name="nQTDParc" id="iQTDParc" style="display: none">
                                        <option value="">Selecione</option>
                                        <option value="2">2x</option>
                                        <option value="3">3x</option>
                                        <option value="4">4x</option>
                                        <option value="5">5x</option>
                                        <option value="6">6x</option>
                                        <option value="7">7x</option>
                                        <option value="8">8x</option>
                                        <option value="9">9x</option>
                                        <option value="10">10x</option>
                                        <option value="11">11x</option>
                                        <option value="12">12x</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-details">
                    <div class="row">
                        <h3 class="title">Selecione a forma de envio do Comprovante</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3 my-2">
                                <select class="form-control" name="nTipoEnvio" id="nTipoEnvio" onchange="tipoEnvio(this.value)" required>
                                    <option value="">Selecione</option>
                                    <option value="Email">Email</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="SMS">SMS</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                               <input class="form-control" onblur="validacaoEmail(checkout.nEmail)" type="email" name="nEmail" id="iEmail" style="display: none" placeholder="exemplo@exemplo.com">
                               <input class="form-control" onblur="verificaNumero(checkout.nSms)" type="text" name="nSms" id="iSms" style="display: none" maxlength="11" placeholder="Apenas Números">
                               <input class="form-control" onblur="verificaNumero(checkout.nWapp)" type="text" name="nWapp" id="iWapp" style="display: none" maxlength="11" placeholder="Apenas Números"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12" id="TipoEnvioValue">
                            
                        </div>
                    </div>
                    <div class="container">
                        <span class="text-danger" id="msgRetorno"></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $estabelecimento->getNome() ?>" name="nEstabelecimento">
                    <input type="hidden" value="<?php echo $estabelecimento->getCnpj() ?>" name="nCNPJ">
                    <input type="hidden" value="<?php echo $estabelecimento->getEmail()?>" name="nContatoEstabelecimento" id="iContatoEstabelecimento">
                    <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                    <br>
                </div>
            </div>
                </form>
        </div>
        </section>
       
            <!-- Modal status-->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Vendas efetuadas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <table class="table table-sm table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">First</th>
                                  <th scope="col">Last</th>
                                  <th scope="col">Handle</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td colspan="2">Larry the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td colspan="2">Larry the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td colspan="2">Larry the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                    </div>
                  </div>
                </div>

        </main>
        </body>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/mascaras.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        
        <script>
            function moeda(z){
            v = z.value;
            v=v.replace(/\D/g,"") //permite digitar apenas números
            v=v.replace(/[0-9]{7}/,"inválido") //limita pra máximo 999.999.999,99
            v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") //coloca ponto antes dos últimos 8 digitos
            v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2") //coloca ponto antes dos últimos 5 digitos
            //v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") //coloca virgula antes dos últimos 2 digitos
            z.value = v;
        }
        </script>
        <script>
            function tipoEnvio(tipoEnvio){
                if(tipoEnvio == "Email"){
                    envioEmail();
                }else if(tipoEnvio == "WhatsApp"){
                    envioWapp();
                }
            }
        </script>
        <script>
            function formaParcelada(formPag){
                if(formPag == "Parcelada"){
                    document.getElementById('iQTDParc').style.display="block";
                }else if(formPag == "À Vista"){
                    document.getElementById('iQTDParc').style.display="none";
                }
        }
        </script>
        <script>
            function formaVista(){
            document.getElementById('iQTDParc').style.display="none";
        }
        </script>
        <script>
        function envioEmail(){
            document.getElementById('iEmail').style.display="block";
            document.getElementById('iSms').style.display="none";
            document.getElementById('iWapp').style.display="none";
        }
        </script>
        <script>
        function envioSms(){
            document.getElementById('iEmail').style.display="none";
            document.getElementById('iSms').style.display="block";
            document.getElementById('iWapp').style.display="none";
        }
        </script>
        <script>
            function envioWapp(){
            document.getElementById('iEmail').style.display="none";
            document.getElementById('iSms').style.display="none";
            document.getElementById('iWapp').style.display="block";
        }
        </script>
        <script>
            function validacaoEmail(field) {
            usuario = field.value.substring(0, field.value.indexOf("@"));
            dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
            if ((usuario.length >=1) &&
                (dominio.length >=3) && 
                (usuario.search("@")==-1) && 
                (dominio.search("@")==-1) &&
                (usuario.search(" ")==-1) && 
                (dominio.search(" ")==-1) &&
                (dominio.search(".")!=-1) &&      
                (dominio.indexOf(".") >=1)&& 
                (dominio.lastIndexOf(".") < dominio.length - 1)) {
            }else{
                document.getElementById("msgRetorno").innerHTML="<font color='red'>E-mail inválido </font>";
                alert("E-mail invalido");
            }
            }
        </script>
        <script>
            function verificaNumero(numero){
            var num = numero.value;
            num=num.replace(/\D/g,"") //permite digitar apenas números
            if(num.length < 11){
                document.getElementById("msgRetorno").innerHTML="<font color='red'>Digite Apenas Numeros com DDD</font>";
                alert("Telefone inválido");
            }else{
                document.getElementById("msgRetorno").innerHTML="<font color='red'>Numero de Telefone Válido!</font>";
                }
            }
        </script>
    </body>
</html>
<?php
    require_once '../classes/EnviarLink.php';
    require_once '../classes/Estabelecimento.php';
    require_once '../classes/Link.php';
    
    if($_POST['nTipoEnvio'] == "Email"){
        $contatoEnvio = $_POST['nEmail'];
    }else if($_POST['nTipoEnvio'] == "SMS"){
        $contatoEnvio = $_POST['nSMS'];
    }else if($_POST['nTipoEnvio'] == "WhatsApp"){
        $contatoEnvio = $_POST['nWapp'];
    }
    
    $dados = array('nome' => $_POST['nEstabelecimento'], 'cnpj' => $_POST['nCNPJ'], 'valorTransacao' => $_POST['nValor'], 
        'tipoTransacao' => $_POST['nFormaPag'], 'qtdParcela' => $_POST['nQTDParc'], 'tipoEnvio' => $_POST['nTipoEnvio'], 
        'contatoEnvio' => $contatoEnvio, 'contatoEstabelecimento' => $_POST['nContatoEstabelecimento']);
    
 
    
    
    $link = new Link($dados);
    
    $linkCriado = $link->gerarLink();
    
    $enviar = new EnviarLink($linkCriado, $dados);
    
    if($enviar->enviarEmail()){
        echo "<script> alert('Link Encaminhado com Sucesso. Acompanhe o Status da transação no Menu -> Status Transações!'); location.href='../interface/index.php';</script>";
    }else{
        echo "<script> alert('Falha ao Encaminhar Link para Pagamento. Tente novamente!'); location.href='../interface/index.php';</script>";

    }
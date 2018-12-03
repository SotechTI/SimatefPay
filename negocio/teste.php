<?php
    require_once '../classes/Link.php';
    require_once '../classes/Estabelecimento.php';
    require_once '../classes/EnviarLink.php';
    
    $dados = array('nome' => "Sotech", 'cnpj' => "08.865.229/0001-09", 'valorTransacao' => 300, 'tipoTransacao' => "Parcelado", 
        'qtdParcela' => 3, 'tipoEnvio' => "email", 'contatoEnvio' => 'luan.michel@live.com', 
        'contatoEstabelecimento' => 'suporte@sotech.com.br');
    
    var_dump($_POST['nContatoRemetente'], $_POST['nContatoEnvio']); 
    
    
    


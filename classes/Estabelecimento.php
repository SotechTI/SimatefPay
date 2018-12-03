<?php
    require_once 'Conexao.php';
class Estabelecimento {
    private $cnpj;
    private $nome;
    private $email;
    private $sms;
    private $wapp;
    private $telefone;
    private $conn;
    
    function __construct($cnpj) {
        $this->conn = new Conexao();
        $this->getConn()->conectar();
        $this->buscarDados($cnpj);
    }

    public function buscarDados($cnpj){
        $sql = "SELECT * FROM estabelecimento WHERE cnpj = '".$cnpj."' ";
        $result = $this->conn->conexao->query($sql);
        
        while($row = mysqli_fetch_assoc($result)){
            $this->setCnpj($row['cnpj']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setWapp($row['whatsapp']);
            $this->setSms($row['sms']);
            $this->setTelefone($row['telefone']);
            
        }
    }
    function getCnpj() {
        return $this->cnpj;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSms() {
        return $this->sms;
    }

    function getWapp() {
        return $this->wapp;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getConn() {
        return $this->conn;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSms($sms) {
        $this->sms = $sms;
    }

    function setWapp($wapp) {
        $this->wapp = $wapp;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

}

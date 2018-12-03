<?php
    require_once 'ILogin.php';
    require_once 'Conexao.php';
    // @author Luan Michel
   class Login implements ILogin {
        private $usuario;
        private $senha;
        private $conn;

        public function __construct($arrayDados) {
            $this->conn = new Conexao();
            $this->getConn()->conectar();
            $this->setUsuario($arrayDados['usuario']);
            $this->setSenha($arrayDados['senha']);
        }
        
        public function verificarLogado() {
            if(!isset($_SESSION["logado"])){
                header("Location: index.php");
                exit();
            }
        }
        
        public function realizarLogin() {
            if(!$this->validarUsuario()){
               return 0;
            }else{
                session_start();
                $_SESSION['usuario'] = $this->getUsuario();
                $_SESSION['logado'] = true;
                if($this->verificarUsuarioAtivo()){
                   return 1;
                }else{
                    header("Location: ../interface/cadastrarSenha.php");
                    exit();
                }
            }
        }
        
        public function validarUsuario() {
            //script de verificação usuario está cadastrado
            $sqlValidaUsuario = "SELECT * FROM usuario WHERE usuario = '".$this->getUsuario()."' ";
            //script de Autenticação de usuario e senha cadastrados
            $sqlAutenticaUsuario = "SELECT * FROM usuario WHERE usuario = '".$this->getUsuario()."' AND "
                    . "senha = '".$this->getSenha()."' ";
            //executa o script de validar usuario cadastrado
            $resultValidaUsuario = $this->getConn()->conexao->query($sqlValidaUsuario);
           
            //Se existir o usuario cadastrado, faz a verificação da senha
            if(!$resultValidaUsuario->num_rows){
                return 0;
            }else{
               //executa a query
                $resultAutenticaUsuario = $this->getConn()->conexao->query($sqlAutenticaUsuario);
                //caso valide usuario e senha, retorna true(1), caso nao exista, retorna false (0)
                if($resultAutenticaUsuario->num_rows == 1){
                    return 1;
                }
           }
        }
     
        public function verificarUsuarioAtivo() {
            $sqlVerificaAtivo = "SELECT * FROM usuario WHERE usuario = '".$this->getUsuario()."' AND "
                   . "senha = '".$this->getSenha()."'";
            $resultVerificaAtivo = $this->getConn()->conexao->query($sqlVerificaAtivo);
            $row = mysqli_fetch_assoc($resultVerificaAtivo);
            if($row['ativo']){
                return 1;
            }else{
                return 0;
            }
        }
        
        public function cadastrarSenha($senha) {
            
        }

        public function realizarLogoff() {
            session_start();
            session_destroy();
            
            header("Location: ../index.php");
        }
        function getUsuario() {
            return $this->usuario;
        }

        function getSenha() {
            return $this->senha;
        }

        function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        function setSenha($senha) {
            $this->senha = $senha;
        }
        function getConn() {
            return $this->conn;
        }

        function setConn($conn) {
            $this->conn = $conn;
        }
}
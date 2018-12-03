<?php
    require_once 'Link.php';
    
    class EnviarLink extends Link{
        private $contatoEnvio;
        private $contatoRemetente;
        
        public function __construct($link, $dados) {
            $this->setLink($link);
            $this->setContatoEnvio($dados['contatoEnvio']);
            $this->setNome($dados['nome']);
            $this->setContatoEnvio($dados['contatoEnvio']);
            $this->setContatoRemetente($dados['contatoEstabelecimento']);
        }
        
        public function enviarEmail(){
            $crpoMsg = '<html>
                <head>
                <title>Pagamento - '.$this->getNome().'</title>
                <meta charset="utf-8">
                </head>
                <body>
                <h1>Segue o Link para efetuar pagamento referente a compra no estabelecimento '.$this->getNome().'</h1>
                <h3><a href="'.$this->getLink().'">Clica Aqui Para Inserir os Dados do Pagamento.</a></h3>
                </body>
                </html>';
                $to      = $this->getContatoEnvio();
                $subject = 'Link para Pagamento da '.$this->getNome().' ';
                $message = $crpoMsg;
                $headers = 'From: '.$this->getContatoRemetente().' ' . "\r\n" .
                'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                'X-Mailer: PHP/' . phpversion();
                
                $result =  mail($to, $subject, $message, $headers);
                
                return $result;
        }

        function getContatoEnvio() {
            return $this->contatoEnvio;
        }

        function setContatoEnvio($contatoEnvio) {
            $this->contatoEnvio = $contatoEnvio;
        }
        
        function getContatoRemetente() {
            return $this->contatoRemetente;
        }

        function setContatoRemetente($contatoRemetente) {
            $this->contatoRemetente = $contatoRemetente;
        }


    }

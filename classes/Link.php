<?php
    //Superclasse
    require_once 'Estabelecimento.php';
    
    class Link extends Estabelecimento{
        private $valorTransacao;
        private $tipoTransacao;
        private $qtdParcela;
        private $tipoEnvio;
        private $dadosLink;
        private $link;
        
        public function __construct($dados) {
            $this->setValorTransacao($dados['valorTransacao']);
            $this->setTipoTransacao($dados['tipoTransacao']);
            $this->setTipoEnvio($dados['tipoEnvio']);
            $this->setCnpj($dados['cnpj']);
            $this->setNome($dados['nome']);
            $this->setQtdParcela($dados['qtdParcela']);
            
            $this->setDadosLink($dadosLink = array('nome' => $this->getNome(), 'cnpj' => $this->getCnpj(), 
                'valorTransacao' => $this->getValorTransacao(), 'tipoTransacao' => $this->getTipoTransacao(), 
                'tipoEnvio' => $this->getTipoEnvio(), 'qtdParcela' => $this->getQtdParcela()));
        }
        
        public function gerarLink() {
            //Transforma o array com os dados em string
            $str = http_build_query($this->getDadosLink());
            //filtra o parametros e retira caracteres indesejáveis
            $strfinal = urldecode ($str);
            //URL final momentada 
            $link = "https://pay.simatef.com.br/cadastrarVenda.php?".$strfinal."";
            
            $this->setLink($link);
            
            return $link;   
        }
        
        function getValorTransacao() {
            return $this->valorTransacao;
        }

        function getTipoTransacao() {
            return $this->tipoTransacao;
        }

        function getQtdParcela() {
            return $this->qtdParcela;
        }

        function getTipoEnvio() {
            return $this->tipoEnvio;
        }

        function setValorTransacao($valorTransacao) {
            $this->valorTransacao = $valorTransacao;
        }

        function setTipoTransacao($tipoTransacao) {
            $this->tipoTransacao = $tipoTransacao;
        }

        function setQtdParcela($qtdParcela) {
            $this->qtdParcela = $qtdParcela;
        }

        function setTipoEnvio($tipoEnvio) {
            $this->tipoEnvio = $tipoEnvio;
        }
        
        function getDadosLink() {
            return $this->dadosLink;
        }

        function setDadosLink($dadosLink) {
            $this->dadosLink = $dadosLink;
        }
        
        function getLink() {
            return $this->link;
        }

        function setLink($link) {
            $this->link = $link;
        }
    }

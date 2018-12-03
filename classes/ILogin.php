<?php

interface ILogin{
    public function realizarLogin(); //Array com Usuario e senha para Validação
    public function realizarLogoff(); // Destroi a sessão, realizando logoff
    public function verificarLogado();
    public function validarUsuario();
    public function verificarUsuarioAtivo();
    public function cadastrarSenha($senha);
}

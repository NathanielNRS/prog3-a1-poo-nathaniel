<?php
class Usuario
{
    private $nome;
    private $email;
    private $senhaHash;

    public function __construct($nome, $email, $senha)
    {
        $this->nome = $this->sanitizar($nome);
        $this->email = $this->validarEmail($email);
        $this->senhaHash = $this->hashSenha($senha);
    }

    private function sanitizar($dado)
    {
        return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
    }

    private function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido");
        }
        return $email;
    }

    private function hashSenha($senha)
    {
        if (strlen($senha) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres");
        }
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenhaHash()
    {
        return $this->senhaHash;
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senhaHash);
    }
}

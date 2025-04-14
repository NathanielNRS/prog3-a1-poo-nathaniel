<?php
require_once '../Classes/Autenticador.php';
require_once '../Classes/Sessao.php';

Sessao::iniciar();

try {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    // Validações
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        throw new Exception("Todos os campos são obrigatórios");
    }

    if ($senha !== $confirmarSenha) {
        throw new Exception("As senhas não coincidem");
    }

    $resultado = Autenticador::registrarUsuario($nome, $email, $senha);

    if (!$resultado) {
        throw new Exception("E-mail já cadastrado");
    }

    // Login automático após cadastro
    Sessao::set('usuario', [
        'nome' => $resultado->getNome(),
        'email' => $resultado->getEmail()
    ]);

    header('Location: dashboard.php');
    exit();

} catch (Exception $e) {
    Sessao::set('erro_cadastro', $e->getMessage());
    header('Location: cadastro.php');
    exit();
}
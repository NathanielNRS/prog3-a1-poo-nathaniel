<?php
require_once '../Classes/Autenticador.php';

Sessao::iniciar();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$lembrar = isset($_POST['lembrar']);

try {
    if (empty($email) || empty($senha)) {
        throw new Exception("E-mail e senha são obrigatórios");
    }

    $usuario = Autenticador::autenticar($email, $senha);

    if (!$usuario) {
        throw new Exception("E-mail ou senha incorretos");
    }

    Sessao::set('usuario', [
        'nome' => $usuario->getNome(),
        'email' => $usuario->getEmail()
    ]);

    if ($lembrar) {
        setcookie('lembrar_email', $email, time() + (30 * 24 * 60 * 60), '/');
    } else {
        setcookie('lembrar_email', '', time() - 3600, '/');
    }

    header('Location: dashboard.php');
    exit();

} catch (Exception $e) {
    Sessao::set('erro_login', $e->getMessage());
    header('Location: login.php');
    exit();
}
<?php
require_once '../Classes/Sessao.php';
Sessao::iniciar();

if (!Sessao::existe('usuario')) {
    header('Location: login.php');
    exit();
}

$usuario = Sessao::get('usuario');
$emailCookie = $_COOKIE['lembrar_email'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .info-box { background: #f5f5f5; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($usuario['nome']) ?>!</h1>
    
    <div class="info-box">
        <h3>Informações da Conta</h3>
        <p>E-mail: <?= htmlspecialchars($usuario['email']) ?></p>
        
        <?php if ($emailCookie): ?>
        <p><small>(E-mail lembrado: <?= htmlspecialchars($emailCookie) ?>)</small></p>
        <?php endif; ?>
    </div>
    
    <a href="logout.php">Sair</a>
</body>
</html>
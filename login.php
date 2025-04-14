<?php
require_once '../Classes/Sessao.php';
Sessao::iniciar();

// Verificar se já está logado
if (Sessao::existe('usuario')) {
    header('Location: dashboard.php');
    exit();
}

$erro = Sessao::get('erro_login');
$sucesso = Sessao::get('sucesso_cadastro');
Sessao::set('erro_login', null);
Sessao::set('sucesso_cadastro', null);

// Verificar cookie de e-mail
$emailSalvo = $_COOKIE['lembrar_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
        input, button { display: block; width: 100%; padding: 8px; margin-bottom: 10px; }
        .lembrar { display: flex; align-items: center; margin-bottom: 10px; }
        .lembrar input { width: auto; margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Login</h1>
    
    <?php if ($erro): ?>
        <div class="error"><?= $erro ?></div>
    <?php endif; ?>
    
    <?php if ($sucesso): ?>
        <div class="success"><?= $sucesso ?></div>
    <?php endif; ?>
    
    <form action="processa_login.php" method="post">
        <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($emailSalvo) ?>" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <div class="lembrar">
            <input type="checkbox" name="lembrar" id="lembrar" <?= $emailSalvo ? 'checked' : '' ?>>
            <label for="lembrar">Lembrar meu e-mail</label>
        </div>
        <button type="submit">Entrar</button>
    </form>
    
    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
</body>
</html>
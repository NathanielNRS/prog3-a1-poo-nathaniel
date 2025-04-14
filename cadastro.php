<?php
require_once '../Classes/Sessao.php';
Sessao::iniciar();

$erro = Sessao::get('erro_cadastro');
Sessao::set('erro_cadastro', null);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; }
        .error { color: red; margin-bottom: 10px; }
        input, button { display: block; width: 100%; padding: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    
    <?php if ($erro): ?>
        <div class="error"><?= $erro ?></div>
    <?php endif; ?>
    
    <form action="processa_cadastro.php" method="post">
        <input type="text" name="nome" placeholder="Nome completo" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
        <button type="submit">Cadastrar</button>
    </form>
    
    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
</body>
</html>
<?php
require_once '../Classes/Sessao.php';
Sessao::iniciar();

// Destruir a sessão
Sessao::destruir();

// Redirecionar para login
header('Location: login.php');
exit();
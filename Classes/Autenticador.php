<?php
require_once 'Usuario.php';
require_once 'Sessao.php';

class Autenticador {
    private static $usuarios = [];
    private static $arquivo = 'usuarios.json';

    public static function init() {
        self::carregarUsuarios();
    }

    private static function carregarUsuarios() {
        if (file_exists(self::$arquivo)) {
            $dados = json_decode(file_get_contents(self::$arquivo), true);
            foreach ($dados as $usuario) {
                $u = new Usuario($usuario['nome'], $usuario['email'], 'tempor');
                $reflection = new ReflectionClass($u);
                $property = $reflection->getProperty('senhaHash');
                $property->setAccessible(true);
                $property->setValue($u, $usuario['senhaHash']);
                self::$usuarios[] = $u;
            }
        }
    }

    private static function salvarUsuarios() {
        $dados = [];
        foreach (self::$usuarios as $usuario) {
            $dados[] = [
                'nome' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'senhaHash' => $usuario->getSenhaHash()
            ];
        }
        file_put_contents(self::$arquivo, json_encode($dados));
    }

    public static function registrarUsuario($nome, $email, $senha) {
        foreach (self::$usuarios as $usuario) {
            if ($usuario->getEmail() === $email) {
                return false;
            }
        }

        $usuario = new Usuario($nome, $email, $senha);
        self::$usuarios[] = $usuario;
        self::salvarUsuarios();
        return $usuario;
    }

    public static function autenticar($email, $senha) {
        foreach (self::$usuarios as $usuario) {
            if ($usuario->getEmail() === $email) {
                return $usuario->verificarSenha($senha) ? $usuario : false;
            }
        }
        return false;
    }
}

// Inicializa o autenticador
Autenticador::init();
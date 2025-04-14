<?php
class Sessao {
    public static function iniciar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($chave, $valor) {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function get($chave, $padrao = null) {
        self::iniciar();
        return $_SESSION[$chave] ?? $padrao;
    }

    public static function destruir() {
        self::iniciar();
        session_unset();
        session_destroy();
    }

    public static function existe($chave) {
        self::iniciar();
        return isset($_SESSION[$chave]);
    }
}
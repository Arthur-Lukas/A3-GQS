<?php
    class Conexao {
        private static $host = 'localhost';
        private static $dbname = 'db_biblioteca';
        private static $user = 'root';
        private static $password = '';

        public static function conectar() {
            try {
                return new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
    }
?>
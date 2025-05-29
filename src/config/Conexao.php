<?php
namespace App\config;

use PDO;
use PDOException;

class Conexao
{
    private static $instancia = null;

    private function __construct() {}

    public static function conectar()
    {
        if (self::$instancia === null) {
            try {
                self::$instancia = new PDO('mysql:host=localhost;dbname=db_biblioteca', 'root', '');
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>
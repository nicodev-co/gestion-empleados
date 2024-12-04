<?php
namespace Core;

use PDO;
use PDOException;

class Db {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            $config = require __DIR__. '/../config/config.php';
            $dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'].';charset='.$config['db']['charset'];
            $username = $config['db']['username'];
            $password = $config['db']['password'];
            try {
                self::$instance = new PDO($dsn, $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error al conectar a la base de datos: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>
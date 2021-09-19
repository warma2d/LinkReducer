<?php

namespace LinkReducer\Core\Database;

use LinkReducer\Core\Service\EnvGetter;
use M1\Env\Parser;

class PDO {

    private static \PDO|null $pdo = null;

    public static function getInstance(): \PDO
    {
        if (self::$pdo === null) {

            $env = EnvGetter::get();

            self::$pdo = new \PDO("{$env['DB_CONNECTION']}:host={$env['DB_HOST']};dbname={$env['DB_DATABASE']}", $env['DB_USERNAME'], $env['DB_PASSWORD'], array(
                \PDO::ATTR_PERSISTENT => true,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ));
        }

        return self::$pdo;
    }

    private function __construct() { }
    private function __clone() { }
    public function __wakeup() {}
}

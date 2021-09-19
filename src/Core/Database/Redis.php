<?php

namespace LinkReducer\Core\Database;

use M1\Env\Parser;
use Predis\Client;

class Redis {

    private static Client|null $redis = null;

    public static function getInstance(): Client
    {
        if (self::$redis === null) {

            if (basename(getcwd()) === 'src') {
                $envFileName = '../.env';
            } else {
                $envFileName = '../../.env';
            }

            $env = Parser::parse(file_get_contents($envFileName));

            $single_server = array(
                'host' => $env['REDIS_HOST'],
                'port' => $env['REDIS_PORT'],
            );

            self::$redis = new Client($single_server);
        }

        return self::$redis;
    }

    private function __construct() { }
    private function __clone() { }
    public function __wakeup() {}
}

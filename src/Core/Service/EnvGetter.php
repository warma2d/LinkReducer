<?php

namespace LinkReducer\Core\Service;

use M1\Env\Parser;

class EnvGetter {

    public static function get(): array
    {
        if (basename(getcwd()) === 'src') {
            $envFileName = '../.env';
        } else {
            $envFileName = '../../.env';
        }

        return Parser::parse(file_get_contents($envFileName));
    }
}

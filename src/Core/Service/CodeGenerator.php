<?php

namespace LinkReducer\Core\Service;

class CodeGenerator {

    public static function generateCode(int $length): string
    {
        $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $shuffled = str_shuffle($alphabet);

        return substr($shuffled, 0, $length).'';
    }
}

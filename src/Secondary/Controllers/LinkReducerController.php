<?php

namespace LinkReducer\Secondary\Controllers;

use LinkReducer\Core\Service\JsonDataValidator;
use LinkReducer\Core\Service\LinkReducer;

class LinkReducerController {
    public static function getShortLink()
    {
        $data = JsonDataValidator::validateAndDecode(file_get_contents('php://input'));
        echo (new LinkReducer)->getShortLink($data);
    }
}

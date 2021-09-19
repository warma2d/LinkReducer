<?php

use LinkReducer\Core\Exceptions\ApplicationException;
use LinkReducer\Secondary\Router\AppRouter;

require_once(__DIR__.'/../vendor/autoload.php');

try {
    AppRouter::run();
} catch (ApplicationException $exception) {
    echo json_encode(['error' => $exception->getMessage()]);
} catch (\Exception $exception) {
    echo json_encode(['error' => 'System error, please, try again later']);
}


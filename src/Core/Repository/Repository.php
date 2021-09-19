<?php

namespace LinkReducer\Core\Repository;

use LinkReducer\Core\Database\PDO;

abstract class Repository {

    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = PDO::getInstance();
    }
}

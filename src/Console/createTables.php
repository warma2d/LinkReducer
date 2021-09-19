<?php

use LinkReducer\Core\Model\Link;
use LinkReducer\Core\Database\PDO;

require_once(__DIR__.'/../../vendor/autoload.php');

$pdo = PDO::getInstance();

$sql = 'create table if not exists '.Link::TABLE_NAME.'
(
	'.Link::ID.' int auto_increment, '
    .Link::SOURCE_LINK.' varchar(2000) not null, '
    .Link::SHORT_CODE.' varchar(6) not null, '
    .Link::AT_CREATED.' datetime default NOW() not null, '
    .Link::AT_DELETED.' datetime default null null,
	constraint '.Link::TABLE_NAME.'_pk
		primary key ('.Link::ID.')
);';

$pdo->query($sql);

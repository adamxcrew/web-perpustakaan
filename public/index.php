<?php

if (!session_id()) session_start();
require '../vendor/autoload.php';

if (file_exists('../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();
}

require_once '../app/init.php';

$app = new App;

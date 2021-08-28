<?php

if (!session_id()) session_start();
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'app/init.php';

$app = new App;
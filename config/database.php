<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$config = [
    'driver' => 'mysql',
    'host' => $host,
    'database' => $dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_0900_ai_ci',
    'prefix' => '',
];

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

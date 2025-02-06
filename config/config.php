<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return [
    'app' => [
        'name' => 'Cabinet Médical',
        'url' => $_ENV['APP_URL'],
        'env' => $_ENV['APP_ENV']
    ],
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'type' => 'pgsql'
    ]
];


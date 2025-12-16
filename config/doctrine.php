<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [dirname(__DIR__) . '/src/Entity'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => $_ENV['DB_HOST'] ?? '127.0.0.1',
    'port'     => (int)($_ENV['DB_PORT'] ?? 3306),
    'dbname'   => $_ENV['DB_NAME'] ?? '',
    'user'     => $_ENV['DB_USER'] ?? '',
    'password' => $_ENV['DB_PASS'] ?? '',
    'charset'  => 'utf8mb4',
], $config);

return new EntityManager($connection, $config);

<?php

declare(strict_types=1);

return (function (): PDO {
    $config = [
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'dbname' => getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
    ];

    $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

    try {
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        throw new PDOException("Could not connect to the database: " . $e->getMessage());
    }
})();
<?php

declare(strict_types=1);

use App\Controllers\ChessController;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $pdo = require __DIR__ . '/config/db.php';
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    return;
}

$chessController = new ChessController($pdo);
$chessController->showPosition($id);

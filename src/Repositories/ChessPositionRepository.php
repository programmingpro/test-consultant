<?php

namespace App\Repositories;

use App\Models\ChessPositionModel;
use PDO;

class ChessPositionRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPositionById(int $id): ?ChessPositionModel
    {
        if ($id <= 0) {
            return null;
        }
        $stmt = $this->pdo->prepare("SELECT id, fen, created_at FROM chess_positions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new ChessPositionModel(
                created_at: $data['created_at'],
                fen: $data['fen'],
                id: (int)$data['id']
            );
        }

        return null;
    }
}
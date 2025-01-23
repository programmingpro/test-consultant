<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class ChessPositionModel
{
    public function __construct(
        private string $created_at,
        private string $fen,
        private int    $id,
    ) {
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getFen(): string
    {
        return $this->fen;
    }

    public function setFen(string $fen): void
    {
        $this->fen = $fen;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
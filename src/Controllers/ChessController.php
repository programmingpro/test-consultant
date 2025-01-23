<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\ChessPositionRepository;
use App\Views\ChessBoardView;
use PDO;

class ChessController {
    public function __construct(private PDO $pdo)
    {
    }

    public function showPosition(int $id): void {
        $chessRepo = new ChessPositionRepository($this->pdo);
        $model = $chessRepo->getPositionById($id);

        if ($model) {
            $this->renderChessBoard($model->getFen());
        } else {
            echo "Position not found.";
        }
    }

    private function renderChessBoard(string $fen): void {
        ChessBoardView::render($fen);
    }
}
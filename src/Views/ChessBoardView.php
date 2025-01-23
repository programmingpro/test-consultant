<?php

declare(strict_types=1);

namespace App\Views;

class ChessBoardView {
    public static function render(string $fen): void {
        $pieces = [
            'p' => '♟', 'r' => '♜', 'n' => '♞', 'b' => '♝', 'q' => '♛', 'k' => '♚',
            'P' => '♙', 'R' => '♖', 'N' => '♘', 'B' => '♗', 'Q' => '♕', 'K' => '♔'
        ];

        $rows = explode('/', $fen);
        $boardHtml = '<div style="display: grid; grid-template-columns: repeat(8, 50px); gap: 0;">';

        foreach ($rows as $rowIndex => $row) {
            $colIndex = 0;
            for ($i = 0; $i < strlen($row); $i++) {
                $char = $row[$i];

                if (is_numeric($char)) {
                    // Добавляем пустые клетки
                    for ($j = 0; $j < (int)$char; $j++) {
                        $bgColor = (($colIndex + $rowIndex) % 2 == 0) ? '#f0d9b5' : '#b58863';
                        $boardHtml .= "<div style='width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: $bgColor;'></div>";
                        $colIndex++;
                    }
                } else {
                    // Добавляем клетку с фигурой
                    $bgColor = (($colIndex + $rowIndex) % 2 == 0) ? '#f0d9b5' : '#b58863';
                    $piece = $pieces[$char] ?? '·';
                    $boardHtml .= "<div style='width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: $bgColor; font-size: 24px;'>$piece</div>";
                    $colIndex++;
                }
            }
        }

        $boardHtml .= '</div>';
        echo $boardHtml;
    }
}

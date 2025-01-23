<?php

declare(strict_types=1);

namespace App\Views;

class ChessBoardView {
    private const PIECES = [
        'p' => '♟', 'r' => '♜', 'n' => '♞', 'b' => '♝', 'q' => '♛', 'k' => '♚',
        'P' => '♙', 'R' => '♖', 'N' => '♘', 'B' => '♗', 'Q' => '♕', 'K' => '♔'
    ];

    private const LIGHT_CELL_COLOR = '#f0d9b5';
    private const DARK_CELL_COLOR = '#b58863';
    private const CELL_SIZE = 50; // Размер клетки в пикселях

    public static function render(string $fen): void {
        $rows = explode('/', $fen);
        $boardHtml = sprintf('<div style="display: grid; grid-template-columns: repeat(8, %dpx); gap: 0;">', self::CELL_SIZE);

        foreach ($rows as $rowIndex => $row) {
            $colIndex = 0;
            for ($i = 0; $i < strlen($row); $i++) {
                $char = $row[$i];

                if (is_numeric($char)) {
                    // Добавляем пустые клетки
                    for ($j = 0; $j < (int)$char; $j++) {
                        $boardHtml .= self::renderCell($rowIndex, $colIndex);
                        $colIndex++;
                    }
                } else {
                    // Добавляем клетку с фигурой
                    $piece = self::PIECES[$char] ?? '·';
                    $boardHtml .= self::renderCell($rowIndex, $colIndex, $piece);
                    $colIndex++;
                }
            }
        }

        $boardHtml .= '</div>';
        echo $boardHtml;
    }

    private static function renderCell(int $rowIndex, int $colIndex, string $content = ''): string {
        $bgColor = self::getCellColor($rowIndex, $colIndex);
        return sprintf(
            "<div style='width: %dpx; height: %dpx; display: flex; align-items: center; justify-content: center; background-color: %s; font-size: 24px;'>%s</div>",
            self::CELL_SIZE,
            self::CELL_SIZE,
            $bgColor,
            $content
        );
    }

    private static function getCellColor(int $rowIndex, int $colIndex): string {
        return (($rowIndex + $colIndex) % 2 === 0) ? self::LIGHT_CELL_COLOR : self::DARK_CELL_COLOR;
    }
}

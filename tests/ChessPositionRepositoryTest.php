<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repositories\ChessPositionRepository;
use App\Models\ChessPositionModel;
use PDO;
use PDOStatement;

class ChessPositionRepositoryTest extends TestCase
{
    public function testGetPositionByIdWithExistingPosition(): void
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
            ->method('execute')
            ->with(['id' => 1]);

        $mockStmt->expects($this->once())
            ->method('fetch')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn([
                'id' => 1,
                'fen' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR',
                'created_at' => '2025-01-23'
            ]);

        $mockPdo = $this->createMock(PDO::class);
        $mockPdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT id, fen, created_at FROM chess_positions WHERE id = :id")
            ->willReturn($mockStmt);

        $repository = new ChessPositionRepository($mockPdo);

        $result = $repository->getPositionById(1);

        $this->assertInstanceOf(ChessPositionModel::class, $result);
        $this->assertEquals(1, $result->getId());
        $this->assertEquals('2025-01-23', $result->getCreatedAt());
        $this->assertEquals('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR', $result->getFen());
    }

    public function testGetPositionByIdWithNonExistingPosition(): void
    {
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
            ->method('execute')
            ->with(['id' => 999]);

        $mockStmt->expects($this->once())
            ->method('fetch')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn(false);

        $mockPdo = $this->createMock(PDO::class);
        $mockPdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT id, fen, created_at FROM chess_positions WHERE id = :id")
            ->willReturn($mockStmt);

        $repository = new ChessPositionRepository($mockPdo);

        $result = $repository->getPositionById(999);

        $this->assertNull($result);
    }

    public function testGetPositionByIdWithNegativeId(): void
    {
        $mockPdo = $this->createMock(PDO::class);
        $mockPdo->expects($this->never()) // Указываем, что prepare не должен вызываться
        ->method('prepare');

        $repository = new ChessPositionRepository($mockPdo);

        $result = $repository->getPositionById(-1);

        $this->assertNull($result); // Проверяем, что метод вернул null
    }


}

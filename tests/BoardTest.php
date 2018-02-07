<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:29
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Board;
use ChessBoard\Entity\PawnFigure;
use ChessBoard\Exception\FailedFigureException;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    const SIZE = 10;

    /** @var Board */
    private $board;

    public function setUp()
    {
        $this->board = new Board(self::SIZE);
    }

    public function testBoardSize()
    {
        $this->assertEquals(self::SIZE, count($this->board->getBoard()));
        $this->assertEquals(self::SIZE, count($this->board->getBoard()[0]));
    }

    public function testPutFigure()
    {
        $pawn = new PawnFigure();
        $this->board->cell(1, 2)->putFigure($pawn);

        $this->assertEquals($pawn, $this->board->cell(1, 2)->getFigure());
        $this->assertNull($this->board->cell(1, 3)->getFigure());
    }

    public function testMoveFigure()
    {
        $pawn = new PawnFigure();
        $from = $this->board->cell(1, 2);
        $from->putFigure($pawn);
        $to = $this->board->cell(3,4);
        $figure = $from->getFigure();

        $this->assertNull($to->getFigure());

        $this->board->moveFigure($from, $to);

        $this->assertNull($from->getFigure());
        $this->assertEquals($figure, $to->getFigure());
    }

    public function testFailedSourceMoveFigure()
    {
        $from = $this->board->cell(1, 2);
        $to = $this->board->cell(3,4);

        $this->assertNull($to->getFigure());

        $this->expectException(FailedFigureException::class);
        $this->expectExceptionMessage('Not found figure in source cell');
        $this->board->moveFigure($from, $to);
    }

    public function testFailedDestinationMoveFigure()
    {
        $pawn = new PawnFigure();

        $from = $this->board->cell(1, 2);
        $from->putFigure($pawn);
        $to = $this->board->cell(3,4);
        $to->putFigure($pawn);

        $this->expectException(FailedFigureException::class);
        $this->expectExceptionMessage('Destination cell is not empty');
        $this->board->moveFigure($from, $to);
    }
}

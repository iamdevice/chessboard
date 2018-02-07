<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:29
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Board;
use ChessBoard\Entity\PawnFigure;
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
}

<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:29
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Board;
use ChessBoard\Entity\Figure;
use ChessBoard\Exception\FailedFigureException;
use ChessBoard\Exception\InvalidCellAddressException;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    const SIZE = 8;

    /** @var Board */
    private $board;

    public function setUp()
    {
        $this->board = new Board();
    }

    public function testBoardSize()
    {
        $this->assertEquals(self::SIZE, count($this->board->getBoard()));
        $this->assertEquals(self::SIZE, count($this->board->getBoard()[1]));
    }

    public function testPutFigure()
    {
        $pawn = Figure::PAWN();
        $this->board->cell('B1')->putFigure($pawn);

        $this->assertEquals($pawn, $this->board->cell('B1')->getFigure());
        $this->assertNull($this->board->cell('C1')->getFigure());
    }

    public function testPutFigureWithUserFunction()
    {
        $pawn = Figure::PAWN();
        $this->board->cell('B1')->putFigure($pawn, function () use ($pawn) {
            echo $pawn->getName() . ' was put on board';
        });

        $this->expectOutputString($pawn->getName() . ' was put on board');
    }

    public function testInvalidCell()
    {
        $this->expectException(InvalidCellAddressException::class);

        $this->expectExceptionMessage('Cell address must have only 2 symbols');
        $this->board->cell('B11')->removeFigure();

        $this->expectExceptionMessage('Cell address must be like B1 or 1B');
        $this->board->cell('BB')->removeFigure();
    }

    public function testMoveFigure()
    {
        $pawn = Figure::PAWN();
        $from = $this->board->cell('B1');
        $from->putFigure($pawn);
        $to = $this->board->cell('3D');
        $figure = $from->getFigure();

        $this->assertNull($to->getFigure());

        $this->board->moveFigure($from, $to);

        $this->assertNull($from->getFigure());
        $this->assertEquals($figure, $to->getFigure());
    }

    public function testFailedSourceMoveFigure()
    {
        $from = $this->board->cell('B1');
        $to = $this->board->cell('D3');

        $this->assertNull($to->getFigure());

        $this->expectException(FailedFigureException::class);
        $this->expectExceptionMessage('Not found figure in source cell');
        $this->board->moveFigure($from, $to);
    }

    public function testFailedDestinationMoveFigure()
    {
        $pawn = Figure::PAWN();

        $from = $this->board->cell('B1');
        $from->putFigure($pawn);
        $to = $this->board->cell('D3');
        $to->putFigure($pawn);

        $this->expectException(FailedFigureException::class);
        $this->expectExceptionMessage('Destination cell is not empty');
        $this->board->moveFigure($from, $to);
    }
}

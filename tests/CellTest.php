<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:18
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Cell;
use ChessBoard\Entity\CellInterface;
use ChessBoard\Entity\PawnFigure;
use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    /** @var CellInterface $cell */
    private $cell;

    public function setUp()
    {
        $this->cell = new Cell();
    }

    public function testPutFigure()
    {
        $figure = new PawnFigure();
        $this->cell->putFigure($figure);

        $this->assertEquals($figure, $this->cell->getFigure());
    }

    public function testRemoveFigure()
    {
        $this->cell->removeFigure();

        $this->assertNull($this->cell->getFigure());
    }
}

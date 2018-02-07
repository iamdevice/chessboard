<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:05
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Figure;
use PHPUnit\Framework\TestCase;

class FigureTest extends TestCase
{
    public function testNewPawnFigure()
    {
        $figure = Figure::PAWN();

        $this->assertEquals('pawn', $figure->getName());
    }
}

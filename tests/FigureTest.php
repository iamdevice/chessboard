<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:05
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\PawnFigure;
use PHPUnit\Framework\TestCase;

class FigureTest extends TestCase
{
    public function testNewPawnFigure()
    {
        $figure = new PawnFigure();

        $this->assertEquals('pawn', $figure->getName());
    }
}

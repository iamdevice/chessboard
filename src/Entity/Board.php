<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:24
 */

namespace ChessBoard\Entity;

class Board implements BoardInterface
{
    /** @var CellInterface[] */
    private $board;

    public function __construct(int $size)
    {
        for ($i = 0; $i < $size; $i++) {
            $this->board[] = array_fill(0, $size, new Cell());
        }
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function cell(int $col, int $row): CellInterface
    {
        return $this->board[$row][$col];
    }

    public function putFigureOnCell(CellInterface $cell, FigureInterface $figure)
    {
        $cell->putFigure($figure);
    }

    public function moveFigure(CellInterface $from, CellInterface $to)
    {
        $figure = $from->getFigure();
        $from->removeFigure();
        $to->putFigure($figure);
    }
}

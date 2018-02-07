<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:23
 */

namespace ChessBoard\Entity;

interface BoardInterface
{
    public function putFigureOnCell(CellInterface $cell, FigureInterface $figure);
    public function moveFigure(CellInterface $from, CellInterface $to);
}

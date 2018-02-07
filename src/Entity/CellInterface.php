<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:13
 */

namespace ChessBoard\Entity;

interface CellInterface
{
    public function putFigure(FigureInterface $figure);
    public function getFigure(): ?FigureInterface;
    public function removeFigure();
}

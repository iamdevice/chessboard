<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:15
 */

namespace ChessBoard\Entity;

class Cell implements CellInterface
{
    /**
     * @var FigureInterface|null $figure
     */
    private $figure = null;

    public function putFigure(FigureInterface $figure)
    {
        $this->figure = $figure;
    }

    public function getFigure()
    {
        return $this->figure;
    }

    public function removeFigure()
    {
        $this->figure = null;
    }
}

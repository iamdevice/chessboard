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

    public function putFigure(FigureInterface $figure, callable $userFunc = null)
    {
        $this->figure = $figure;
        if (!is_null($userFunc)) {
            call_user_func($userFunc);
        }
    }

    public function getFigure(): ?FigureInterface
    {
        return $this->figure;
    }

    public function removeFigure()
    {
        $this->figure = null;
    }
}

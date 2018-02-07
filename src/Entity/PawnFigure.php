<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:11
 */

namespace ChessBoard\Entity;

class PawnFigure implements FigureInterface
{
    const NAME = 'pawn';

    public function getName(): string
    {
        return self::NAME;
    }
}

<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 13:21
 */

namespace ChessBoard\Entity;

use MyCLabs\Enum\Enum;

class Figure extends Enum implements FigureInterface
{
    const PAWN = 'pawn'; // пешка
    const ROOK = 'rook'; // ладья
    const BISHOP = 'bishop'; // слон

    public function getName(): string
    {
        return $this->value;
    }
}

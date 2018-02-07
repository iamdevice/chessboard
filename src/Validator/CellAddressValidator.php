<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:14
 */

namespace ChessBoard\Validator;

use ChessBoard\Exception\InvalidCellAddressException;

class CellAddressValidator
{
    public static function validate(string $cellAddress)
    {
        if (strlen($cellAddress) !== 2) {
            throw new InvalidCellAddressException('Cell address must have only 2 symbols');
        }

        $pattern = '/(?P<addr>[A-H]{1}[1-8]{1}|[1-8]{1}[A-H]{1})/';
        if (preg_match($pattern, $cellAddress) === false) {
            throw new InvalidCellAddressException('Cell address must be like B1 or 1B');
        }
    }
}

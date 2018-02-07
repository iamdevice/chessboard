<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 11:12
 */

namespace ChessBoard\Storage;

class NullStorage implements StorageInterface
{
    /** @var array */
    private $board = [];

    public function save(array $board)
    {
        for ($row = 0; $row < count($board); $row++) {
            for ($col = 0; $col < count($board[$row]); $col++) {
                $this->board[$row][$col] = clone $board[$row][$col];
            }
        }
    }

    public function load()
    {
        return $this->board;
    }
}

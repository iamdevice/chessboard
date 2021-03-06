<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:23
 */

namespace ChessBoard\Entity;

use ChessBoard\Storage\StorageInterface;

interface BoardInterface
{
    public function setStorage(StorageInterface $storage);
    public function getBoard();
    public function cell(string $cell): CellInterface;
    public function moveFigure(CellInterface $from, CellInterface $to): void;
    public function clear();
    public function save();
    public function load();
}

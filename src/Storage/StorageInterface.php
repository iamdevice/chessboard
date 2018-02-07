<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 10:55
 */

namespace ChessBoard\Storage;

interface StorageInterface
{
    public function save(array $board);
    public function load();
}

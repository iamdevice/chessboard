<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 11:04
 */

namespace ChessBoard\Storage;

class FileStorage implements StorageInterface
{
    private $file;

    public function __construct()
    {
        $this->file = tempnam('/tmp', 'chessboard_');
    }

    public function save(array $board)
    {
        $res = fopen($this->file, 'w');
        for ($row = 0; $row < count($board); $row++) {
            for ($col = 0; $col < count($board[$row]); $col++) {
                fputcsv($res, [$row, $col, serialize($board[$row][$col])]);
            }
        }
        fclose($res);
    }

    public function load()
    {
        $res = fopen($this->file, 'r');
        $board = [];
        while ($line = fgetcsv($res)) {
            if (empty($line)) {
                continue;
            }

            list ($row, $col, $cell) = $line;
            $board[$row][$col] = unserialize($cell);
        }

        return $board;
    }
}

<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 11:04
 */

namespace ChessBoard\Storage;

use ChessBoard\Exception\FileNotFoundException;

class FileStorage implements StorageInterface
{
    private $file;

    public function __construct()
    {
        $this->file = __DIR__ . '/../../chessboard.save';
    }

    public function save(array $board)
    {
        $res = fopen($this->file, 'w');
        for ($row = 1; $row < count($board); $row++) {
            foreach (range('A', 'H') as $col) {
                fputcsv($res, [$row, $col, serialize($board[$row][$col])]);
            }
        }
        fclose($res);
    }

    public function load()
    {
        if (!file_exists($this->file)) {
            throw new FileNotFoundException('Not found saved game');
        }

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

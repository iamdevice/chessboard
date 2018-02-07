<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 9:24
 */

namespace ChessBoard\Entity;

use ChessBoard\Exception\FailedFigureException;
use ChessBoard\Storage\NullStorage;
use ChessBoard\Storage\StorageInterface;

class Board implements BoardInterface
{
    const BOARD_SIZE = 8;

    /** @var CellInterface[] */
    private $board;
    /** @var StorageInterface $storage */
    private $storage;

    public function __construct()
    {
        for ($row = 0; $row < self::BOARD_SIZE; $row++) {
            foreach (range('A', 'H') as $col) {
                $this->board[$row+1][$col] = new Cell();
            }
        }
        $this->storage = new NullStorage();
    }

    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function cell(int $row, string $col): CellInterface
    {
        return $this->board[$row][$col];
    }

    public function moveFigure(CellInterface $from, CellInterface $to): void
    {
        if (!is_null($to->getFigure())) {
            throw new FailedFigureException('Destination cell is not empty');
        }

        $figure = $from->getFigure();
        if (is_null($figure)) {
            throw new FailedFigureException('Not found figure in source cell');
        }

        $from->removeFigure();
        $to->putFigure($figure);
    }

    public function clear()
    {
        for ($row = 1; $row < count($this->board); $row++) {
            foreach (range('A', 'H') as $col) {
                $this->cell($row, $col)->removeFigure();
            }
        }
    }

    public function save()
    {
        $this->storage->save($this->board);
    }

    public function load()
    {
        $this->board = $this->storage->load();
    }
}

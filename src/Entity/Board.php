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
    /** @var CellInterface[] */
    private $board;
    /** @var StorageInterface $storage */
    private $storage;

    public function __construct(int $size)
    {
        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                $this->board[$row][$col] = new Cell();
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

    public function cell(int $row, int $col): CellInterface
    {
        return $this->board[$row][$col];
    }

    public function putFigureOnCell(CellInterface $cell, FigureInterface $figure): void
    {
        $cell->putFigure($figure);
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
        for ($row = 0; $row < count($this->board); $row++) {
            for ($col = 0; $col < count($this->board[$row]); $col++) {
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

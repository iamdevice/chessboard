<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 11:15
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Board;
use ChessBoard\Entity\Figure;
use ChessBoard\Storage\FileStorage;
use ChessBoard\Storage\NullStorage;
use ChessBoard\Storage\StorageInterface;
use PHPUnit\Framework\TestCase;

class StorageTest extends TestCase
{
    /**
     * @dataProvider storageDataProvider
     *
     * @param StorageInterface $storage
     * @throws \Exception
     */
    public function testStorage(StorageInterface $storage)
    {
        $board = new Board();
        $board->setStorage($storage);
        $pawn = Figure::PAWN();
        $bishop = Figure::BISHOP();

        $board->cell(1, 'B')->putFigure($pawn);
        $board->cell(1, 'C')->putFigure($bishop);

        $board->save();
        $board->clear();

        $this->assertNull($board->cell(1, 'B')->getFigure());
        $this->assertNull($board->cell(1, 'C')->getFigure());

        $board->load();
        $this->assertEquals($pawn, $board->cell(1, 'B')->getFigure());
        $this->assertEquals($bishop, $board->cell(1, 'C')->getFigure());
        $this->assertNull($board->cell(1,'D')->getFigure());
    }

    public function storageDataProvider()
    {
        return [
            [ new NullStorage() ],
            [ new FileStorage() ]
        ];
    }
}

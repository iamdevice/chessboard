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

        $board->cell('B1')->putFigure($pawn);
        $board->cell('C1')->putFigure($bishop);

        $board->save();
        $board->clear();

        $this->assertNull($board->cell('B1')->getFigure());
        $this->assertNull($board->cell('C1')->getFigure());

        $board->load();
        $this->assertEquals($pawn, $board->cell('B1')->getFigure());
        $this->assertEquals($bishop, $board->cell('C1')->getFigure());
        $this->assertNull($board->cell('D1')->getFigure());
    }

    public function storageDataProvider()
    {
        return [
            [ new NullStorage() ],
            [ new FileStorage() ]
        ];
    }
}

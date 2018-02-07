<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 11:15
 */

namespace ChessBoard\Test;

use ChessBoard\Entity\Board;
use ChessBoard\Entity\PawnFigure;
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
        $board = new Board(10);
        $board->setStorage($storage);
        $pawn = new PawnFigure();
        $board->putFigureOnCell($board->cell(1, 2), $pawn);
        $this->assertEquals($pawn, $board->cell(1, 2)->getFigure());
        $board->save();
        $board->clear();

        $this->assertNull($board->cell(1, 2)->getFigure());

        $board->load();
        $this->assertEquals($pawn, $board->cell(1, 2)->getFigure());
        $this->assertNull($board->cell(1,3)->getFigure());
    }

    public function storageDataProvider()
    {
        return [
            [ new NullStorage() ],
            [ new FileStorage() ]
        ];
    }
}

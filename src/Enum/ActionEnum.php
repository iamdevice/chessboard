<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:47
 */

namespace ChessBoard\Enum;

use ChessBoard\Action\ActionInterface;
use ChessBoard\Action\LoadAction;
use ChessBoard\Action\MoveAction;
use ChessBoard\Action\PrintAction;
use ChessBoard\Action\PutAction;
use ChessBoard\Action\RemoveAction;
use ChessBoard\Action\SaveAction;
use ChessBoard\Entity\BoardInterface;
use MyCLabs\Enum\Enum;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ActionEnum extends Enum
{
    const PUT = 'put figure';
    const MOVE = 'move figure';
    const REMOVE = 'remove figure';
    const SAVE = 'save game';
    const LOAD = 'load last game';
    const PRINT = 'print board';

    private $mapAction = [
        self::PUT => PutAction::class,
        self::MOVE => MoveAction::class,
        self::REMOVE => RemoveAction::class,
        self::SAVE => SaveAction::class,
        self::LOAD => LoadAction::class,
        self::PRINT => PrintAction::class,
    ];

    public function do(QuestionHelper $helper, InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        /** @var ActionInterface $action */
        $action = new $this->mapAction[$this->value]($helper);
        $action->action($input, $output, $board);
    }
}

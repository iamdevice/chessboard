<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 15:02
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SaveAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        $board->save();
    }
}

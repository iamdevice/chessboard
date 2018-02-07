<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:51
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ActionInterface
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board);
}

<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 15:03
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class LoadAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        try {
            $board->clear();
            $board->load();
        } catch (\Exception $error) {
            $output->writeln('ERROR: ' . $error->getMessage());
        }
    }
}

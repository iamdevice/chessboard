<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 15:14
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PrintAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        $cols = [];
        $cols[] = ' ';
        foreach (range('A', 'H') as $col) {
            $cols[] = $col;
        }
        $colString = implode("\t", $cols);

        $output->writeln($colString);

        for ($row = 1; $row <= count($board->getBoard()); $row++) {
            $lineValues = [];
            $lineValues[] = (string)$row;
            foreach (range('A', 'H') as $col) {
                $figure = $board->cell("{$row}{$col}")->getFigure();
                $lineValues[] = is_null($figure) ? ' ' : $figure->getName();
            }
            $line = implode("\t", $lineValues);
            $output->writeln($line);
        }
    }
}

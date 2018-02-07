<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 15:44
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class RemoveAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        $choiceCell = new Question("Input cell to remove figure: ");
        $cell = null;
        while ($cell === null) {
            $cell = $this->helper->ask($input, $output, $choiceCell);
        }

        try {
            $board->cell($cell)->removeFigure();
        } catch (\Exception $error) {
            $output->writeln('ERROR: ' . $error->getMessage());
        }
    }
}

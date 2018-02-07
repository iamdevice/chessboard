<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:59
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class MoveAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        $choiceFrom = new Question('Input source cell: ');
        $from = null;
        while ($from === null) {
            $from = $this->helper->ask($input, $output, $choiceFrom);
        }

        $choiceTo = new Question('Input destination cell: ');
        $to = null;
        while ($to === null) {
            $to = $this->helper->ask($input, $output, $choiceTo);
        }

        try {
            $board->moveFigure($board->cell($from), $board->cell($to));
        } catch (\Exception $error) {
            $output->writeln('ERROR: ' . $error->getMessage());
        }
    }
}

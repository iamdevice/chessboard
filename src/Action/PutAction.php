<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:51
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\BoardInterface;
use ChessBoard\Entity\Figure;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class PutAction extends AbstractAction
{
    public function action(InputInterface $input, OutputInterface $output, BoardInterface $board)
    {
        $choiceFigure = new ChoiceQuestion('Choice a figure [pawn]', Figure::toArray(), Figure::PAWN);
        $figureName = $this->helper->ask($input, $output, $choiceFigure);
        $figure = Figure::{$figureName}();

        $choiceCell = new Question("Input cell to put {$figure->getName()}: ");
        $cell = null;
        while ($cell === null) {
            $cell = $this->helper->ask($input, $output, $choiceCell);
        }

        $board->cell($cell)->putFigure($figure);
    }
}

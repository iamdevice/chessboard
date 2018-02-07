<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 12:35
 */

namespace ChessBoard\Action;

use ChessBoard\Entity\Figure;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class GameAction extends Command
{
    protected function configure()
    {
        $this
            ->setName('game:run')
            ->setDescription('Run game');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $size = $input->getOption('size');

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $choiceFigure = new ChoiceQuestion('Choice a figure', Figure::toArray(), Figure::PAWN);
        $figure = $helper->ask($input, $output, $choiceFigure);

        $choiceRow = new ChoiceQuestion('Choice a row to put figure', range(1, $size));
        $row = $helper->ask($input, $output, $choiceRow);

        $choiceCol = new ChoiceQuestion('Choice a column to put figure', range(1, $size));
    }
}

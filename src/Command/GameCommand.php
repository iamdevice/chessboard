<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 12:35
 */

namespace ChessBoard\Command;

use ChessBoard\Entity\Board;
use ChessBoard\Enum\ActionEnum;
use ChessBoard\Storage\FileStorage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class GameCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('game:run')
            ->setDescription('Run game');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $board = new Board();
        $board->setStorage(new FileStorage());

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        while (true) {
            $actionQuestion = new ChoiceQuestion(
                'Choice an action [PUT]',
                ActionEnum::toArray(),
                ActionEnum::PUT
            );
            $actionName = $helper->ask($input, $output, $actionQuestion);
            /** @var ActionEnum $action */
            $action = ActionEnum::{$actionName}();
            $action->do($helper, $input, $output, $board);
        }
    }
}

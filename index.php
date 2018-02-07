<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 8:42
 */

use Symfony\Component\Console\Application;
use ChessBoard\Command\GameCommand;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application("ChessBoard", "1.0");

$dispatcher = new EventDispatcher();
$dispatcher->addListener(ConsoleEvents::ERROR, function (ConsoleErrorEvent $event) {
    $output = $event->getOutput();
    $output->writeln($event->getError()->getMessage());
});

$app->setDispatcher($dispatcher);
$app->addCommands([
    new GameCommand()
]);
$app->run();
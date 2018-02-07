<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 8:42
 */

use Symfony\Component\Console\Application;
use ChessBoard\Command\GameCommand;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application("ChessBoard", "1.0");
$app->addCommands([
    new GameCommand()
]);
$app->run();
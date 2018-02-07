<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 8:42
 */

use Symfony\Component\Console\Application;

$app = new Application("ChessBoard", "1.0");
$app->addCommands([

]);
$app->run();
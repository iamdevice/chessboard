<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 07.02.2018 14:55
 */

namespace ChessBoard\Action;

use Symfony\Component\Console\Helper\QuestionHelper;

abstract class AbstractAction implements ActionInterface
{
    /** @var QuestionHelper $helper */
    protected $helper;

    public function __construct(QuestionHelper $helper)
    {
        $this->helper = $helper;
    }
}

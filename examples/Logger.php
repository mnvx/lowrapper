<?php

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = []): void
    {
        echo $level . ': <pre>' . $message . '</pre><br/>';
    }
}
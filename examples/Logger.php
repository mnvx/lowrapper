<?php

require __DIR__ . '/../vendor/psr/log/Psr/Log/AbstractLogger.php';

use PSR\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = array())
    {
        echo $level . ': <pre>' . $message . '</pre><br/>';
    }
}
<?php

namespace Bkqw\log\Log\Contracts;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

/**
 * Author: Adam
 * Create at 2020/7/27.
 */
interface LogServiceInterface
{

    public function write($message, array $context = array());

}
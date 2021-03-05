<?php

namespace Bkqw\Log\Log\Contracts;

/**
 * Author: Adam
 * Create at 2020/7/27.
 */
interface LogServiceInterface
{

    public function write($message, array $context = []);

}
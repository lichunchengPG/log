<?php
/**
 * 系统错误日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ErrorLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class ErrorLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'error_log';
    }

}
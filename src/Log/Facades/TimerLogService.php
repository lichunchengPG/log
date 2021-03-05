<?php
/**
 * 定时任务日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class TimerLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class TimerLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'timer_log';
    }

}
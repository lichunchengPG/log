<?php
/**
 * 定时任务日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Facades;

use Illuminate\Support\Facades\Facade;

class TimerLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'timer_log';
    }

}
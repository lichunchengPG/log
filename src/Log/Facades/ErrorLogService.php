<?php
/**
 * 系统错误日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Facades;

use Illuminate\Support\Facades\Facade;

class ErrorLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'error_log';
    }

}
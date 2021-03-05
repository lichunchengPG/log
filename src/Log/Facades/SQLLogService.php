<?php
/**
 * 慢查询日志日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SQLLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class SQLLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'sql_log';
    }

}

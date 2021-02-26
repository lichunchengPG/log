<?php
/**
 * 慢查询日志日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Facades;

use Illuminate\Support\Facades\Facade;

class SQLLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'sql_log';
    }

}

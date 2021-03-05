<?php
/**
 * 系统日志
 * Created by PhpStorm
 * User:lcc
 * Date:2021/3/4
 * Time:9:19
 */

namespace Bkqw\Log\Log\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class SystemLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class SystemLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'system_log';
    }
}
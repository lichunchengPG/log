<?php
/**
 * api路由日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AdminRouteLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class AdminRouteLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'admin_route_log';
    }

}
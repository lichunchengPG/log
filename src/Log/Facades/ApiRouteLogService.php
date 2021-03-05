<?php
/**
 * api路由日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ApiRouteLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class ApiRouteLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'api_route_log';
    }

}
<?php
/**
 * api路由日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Facades;

use Illuminate\Support\Facades\Facade;

class ApiRouteLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'api_route_log';
    }

}
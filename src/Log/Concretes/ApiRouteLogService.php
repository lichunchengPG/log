<?php
/**
 * api路由日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Concretes;

class ApiRouteLogService extends BaseLogService
{

    protected $name = 'api_route';

    protected $maxFiles = 15;

}
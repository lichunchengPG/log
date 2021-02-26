<?php
/**
 * 后端路由日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Concretes;

class AdminRouteLogService extends BaseLogService
{

    protected $name = 'admin_route';

    protected $maxFiles = 15;

}
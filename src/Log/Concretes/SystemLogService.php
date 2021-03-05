<?php
/**
 * 系统日志
 * Created by PhpStorm
 * User:lcc
 * Date:2021/3/4
 * Time:9:19
 */

namespace Bkqw\Log\Log\Concretes;

class SystemLogService extends BaseLogService
{
    protected $name = 'system';

    protected $maxFiles = 30;

}
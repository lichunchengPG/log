<?php
/**
 * 调试日志
 * Created by PhpStorm
 * User:lcc
 * Date:2021/3/4
 * Time:9:19
 */

namespace Bkqw\Log\Log\Concretes;

class DebugLogService extends BaseLogService
{
    protected $name = 'debug';

    protected $maxFiles = 30;

}
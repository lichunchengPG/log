<?php
/**
 * 定时任务日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Concretes;

class TimerLogService extends BaseLogService
{
    protected $name = 'timer';

    protected $maxFiles = 90;

}
<?php
/**
 * 系统错误日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Concretes;

class ErrorLogService extends BaseLogService
{

    protected $name = 'error';

    protected $maxFiles = 30;

}
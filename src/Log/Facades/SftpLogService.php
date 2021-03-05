<?php
 /**
 * 远程调用日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SftpLogService
 * @package Bkqw\log\Log\Facades
 * @method static string write($message, array $context = [], $driver = '', $module = '')
 */
class SftpLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'sftp_log';
    }

}

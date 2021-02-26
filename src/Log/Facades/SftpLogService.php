<?php
 /**
 * 远程调用日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Facades;

use Illuminate\Support\Facades\Facade;

class SftpLogService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return  'sftp_log';
    }

}

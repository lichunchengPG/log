<?php
/**
 * 远程调用日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Concretes;

class SftpLogService extends BaseLogService
{
    protected $name = 'sftp';

    protected $maxFiles = 60;

}

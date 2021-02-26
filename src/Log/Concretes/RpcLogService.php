<?php
/**
 * 远程调用日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Concretes;

class RpcLogService extends BaseLogService
{
    protected $name = 'rpc';

    protected $maxFiles = 60;

}
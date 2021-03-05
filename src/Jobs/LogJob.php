<?php

namespace Bkqw\Log\Jobs;

use Bkqw\Log\Log\Concretes\BaseLogService;

/**
 * 写入日志队列任务
 * Class LogJob
 * @package Bkqw\log\Jobs
 */
class LogJob extends Job
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var BaseLogService
     */
    protected $logService;

    /**
     * Create a new job instance.
     *
     * @param BaseLogService $logService
     * @param array $data
     */
    public function __construct(BaseLogService $logService, $data = [])
    {
        $this->data = $data;
        $this->logService = $logService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->logService->writeLog($this->data['message'], $this->data['context'],
            $this->data['logDriver'], $this->data['type'], $this->data['module']);
    }
}

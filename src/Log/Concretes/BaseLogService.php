<?php

namespace Bkqw\log\Log\Concretes;

use Bkqw\log\Exceptions\ServerException;
use Bkqw\log\Log\Contracts\LogServiceInterface;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

/**
 * Author: Adam
 * Create at 2020/7/27.
 */
abstract class BaseLogService implements LogServiceInterface
{
    /**@var $logger Logger */
    protected $logger;

    protected $name;

    protected $maxFiles;

    protected $channel = 'logger';

    protected $level = Logger::DEBUG;

    public function __construct()
    {
        if (!$this->name) {
            throw new ServerException('lack of name');
        }
        if (!$this->maxFiles) {
            throw new ServerException('lack of maxFiles');
        }

        $this->constructLogger();
    }


    protected static function getFacadeAccessor()
    {
        return new static();
    }

    /**
     * 构建日志处理器
     * @param FormatterInterface|null $formatter
     * @author Adam
     * @date 2020/7/28 8:49
     */
    protected function constructLogger(FormatterInterface $formatter = null)
    {
        $logger = new \Monolog\Logger($this->channel);

        $basePath = storage_path("logs/my_logger/{$this->name}_log/{$this->name}.log");

        $handler = new \Monolog\Handler\RotatingFileHandler(
            $basePath,
            $this->maxFiles,
            $this->level
        );

        if (!$formatter) {
            $dateFormat = "Y-m-d H:i:s";
            // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
            $output = "[%datetime%] %channel%.{$this->name}: %message%\n %context%\n";

            $formatter = new LineFormatter($output, $dateFormat, true);
        }

        $handler->setFormatter($formatter);

        $logger->pushHandler($handler);

        $this->logger = $logger;
    }

    /**
     * 写入日志
     * @param string $message
     * @param array  $context
     * @author Adam
     * @date 2020/7/28 8:49
     */
    public function write($message, array $context = array())
    {
        $this->logger->info($message, $context);
    }

}
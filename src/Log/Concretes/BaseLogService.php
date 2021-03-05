<?php

namespace Bkqw\Log\Log\Concretes;

use Bkqw\Log\Exceptions\ServerException;
use Bkqw\Log\Jobs\LogJob;
use Bkqw\Log\Log\Contracts\LogServiceInterface;
use Illuminate\Support\Facades\DB;
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

    protected const DRIVER_DATABASE = 'database';

    protected const DRIVER_FILE = 'file';

    protected const DRIVER = [
        self::DRIVER_DATABASE,
        self::DRIVER_FILE,
    ];

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
     * @param $message
     * @param array $context
     * @param string $driver
     * @param string $module
     * @author Adam
     * @date 2020/7/28 8:49
     */
    public function write($message, array $context = [], $driver = '', $module = '')
    {
        if ($this->checkLogOpen()) {
            // 检查context内容字段
            if (config('bkqw_log.check_fields_toggle', false)) {
                $this->checkLogFields($context, $this->name);
            }
            // 驱动类型
            $logDriver = config('bkqw_log.log_driver', self::DRIVER_DATABASE);
            if ($driver && in_array($driver, self::DRIVER)) {
                $logDriver = $driver;
            }

            // 异步记录
            if (config('bkqw_log.async_toggle', false)) {
                $data = ['message' => $message, 'context' => $context, 'logDriver' => $logDriver,
                         'type' => $this->name, 'module' => $module];
                dispatch(new LogJob($this, $data))->onConnection(config('bkqw_log.async_driver', 'redis'));
            } else {
                $this->writeLog($message, $context, $logDriver, $this->name, $module);
            }
        }
    }


    /**
     * 获取日志服务别名
     * @return string
     */
    public function getAliasName()
    {
        return $this->name . '_log';
    }


    /**
     * 检测日志服务是否开启
     * @return bool
     */
    public function checkLogOpen()
    {
        $logArr       = config('bkqw_log.log_toggle');
        $logAliasName = $this->getAliasName();
        // 默认开启服务
        if (!isset($logArr[$logAliasName]) || $logArr[$logAliasName] === true) {
            return true;
        }
        return false;
    }

    /**
     * 写入日志
     * @param $message
     * @param $context
     * @param $logDriver
     * @param $type
     * @param $module
     */
    public function writeLog($message, $context, $logDriver, $type, $module)
    {
        switch ($logDriver) {
            case self::DRIVER_DATABASE:
                $content = ['message' => $message, 'context' => $context];
                $this->writeLogDatabase($content, $type, $module);
                break;
            case self::DRIVER_FILE:
                $this->logger->info($message, $context);
                break;
            default:
                break;
        }
    }

    /**
     * 写入日志数据库
     * @param $content
     * @param $type
     * @param $module
     */
    public function writeLogDatabase($content, $type, $module)
    {
        DB::connection(config('bkqw_log.database.connection'))
            ->table(config('bkqw_log.database.log_table'))->insert([
                'module'     => $module,
                'type'       => $type,
                'content'    => json_encode($content, JSON_UNESCAPED_UNICODE),
                'created_at' => time(),
                'updated_at' => time(),
            ]);
    }

    /**
     * 检查日志内容字段
     * @param $context
     * @param $type
     * @throws ServerException
     */
    public function checkLogFields($context, $type)
    {
        $validateFields = config('bkqw_log.validate_fields', []);
        if ($validateFields && !empty($validateFields[$type])) {
            foreach ($validateFields[$type] as $field => $value) {
                if ($value && !isset($context[$field])) {
                    throw new ServerException($type . '日志内容缺少' . $field . '字段');
                }
            }
        }
    }

}


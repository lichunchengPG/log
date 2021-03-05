<?php
/**
 * mysql日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\Log\Log\Concretes;

class SQLLogService extends BaseLogService
{
    protected $name = 'sql';

    protected $maxFiles = 90;

    /**
     * 写入日志
     *
     * @param $message
     * @param array $context
     *
     * @param string $driver
     * @param string $module
     * @author Adam
     * @date 2020/7/28 8:49
     */
    public function write($message, array $context = [], $driver = '', $module = '')
    {
        // 检测日志是否打开
        if (!$this->checkLogOpen()) {
            return;
        }

        // 检测是否是日志表操作（避免死循环）
        $table = config('bkqw_log.database.log_table');
        if (strpos($message->sql, $table) !== false) {
            return;
        }

        $longSQL = config('bkqw_log.long_sql_time', 150);

        if (!isset($message->time) || $message->time < $longSQL) {
            return;
        }

        $bindings = $message->bindings;

        $i      = 0;
        $rawSql = preg_replace_callback('/\?/', function ($matches) use ($bindings, &$i) {

            if ($bindings[$i] instanceof \DateTime) {
                $bindings[$i] = $bindings[$i]->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_object($bindings[$i])) {
                    $bindings[$i] = '##error##';
                }
            }
            $item = isset($bindings[$i]) ? $bindings[$i] : $matches[0];
            $i++;
            return gettype($item) == 'string' ? "'$item'" : $item;
        }, $message->sql);

        $context['log_time']  = date('Y-m-d H:i:s');
        $context['sql']       = $rawSql;
        $context['cost_time'] = $message->time . 'ms';
        $context['memo']      = '';

        parent::write('sql日志', $context);
    }

}

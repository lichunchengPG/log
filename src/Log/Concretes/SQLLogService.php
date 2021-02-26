<?php
/**
 * mysql日志
 * Author: Adam
 * Create at 2020/7/27.
 */

namespace Bkqw\log\Log\Concretes;

class SQLLogService extends BaseLogService
{
    protected $name = 'sql';

    protected $maxFiles = 90;

    /**
     * 写入日志
     *
     * @param string $event
     * @param array $context
     *
     * @author Adam
     * @date 2020/7/28 8:49
     */
    public function write($event, array $context = [])
    {
        $longSQL = config('system_setting.long_sql_time', 150);
        if (!isset($event->time) || $event->time < $longSQL) {
            return;
        }

        $bindings = $event->bindings;

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
        }, $event->sql);
        $log    = '[ 执行时间:' . $event->time . 'ms ]' . $rawSql;

        $this->logger->info($log, $context);
    }

}

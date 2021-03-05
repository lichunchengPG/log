<?php
/**
 * Created by PhpStorm
 * User:lcc
 * Date:2021/3/2
 * Time:16:18
 */

namespace Bkqw\Log\Middleware;

use Bkqw\Log\Log\Facades\ApiRouteLogService;
use Closure;

/**
 * 接口访问日志
 * Class ApiRouteLog
 * @package Bkqw\log\Middleware
 */
class ApiRouteLog
{
    public function handle($request, Closure $next)
    {
        $logData    = [
            'url'            => $request->url(),
            'method'         => $request->method(),
            'ip'             => $request->ip(),
            'request_params' => $request->method() === 'GET' ? $request->query() : $request->request->all(),
            'begin_time'     => $this->getMicroTime(),
        ];

        $response = $next($request);

        $logData['response_params'] = $response->getContent();
        $logData['end_time'] = $this->getMicroTime();
        $logData['cost_time'] = $logData['end_time'] - $logData['begin_time'];
        $logData['memo'] = '';

        ApiRouteLogService::write('接口访问日志', $logData, '', 'api');

        return $response;

    }


    /**
     * 获取毫秒时间戳
     * @return string
     */
    public function getMicroTime(): string
    {
        [$microSec, $sec] = explode(' ', microtime());

        return sprintf('%.0f', ($microSec + $sec) * 1000);
    }

}
<?php
/**
 * Created by PhpStorm
 * User:lcc
 * Date:2021/2/26
 * Time:14:54
 */

namespace Bkqw\log\Providers;


use Bkqw\log\Log\Concretes\ApiRouteLogService;
use Bkqw\log\Log\Concretes\ErrorLogService;
use Bkqw\log\Log\Concretes\RpcLogService;
use Bkqw\log\Log\Concretes\SftpLogService;
use Bkqw\log\Log\Concretes\SQLLogService;
use Bkqw\log\Log\Concretes\TimerLogService;
use Illuminate\Support\ServiceProvider;

class BkqwLogServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        // 绑定api路由日志单例
        $this->app->singleton('api_route_log', function () {
            return new ApiRouteLogService();
        });

        // 绑定系统错误日志单例
        $this->app->singleton('error_log', function () {
            return new ErrorLogService();
        });

        // 绑定远程调用日志单例
        $this->app->singleton('rpc_log', function () {
            return new RpcLogService();
        });

        // 绑定定时任务日志单例
        $this->app->singleton('timer_log', function () {
            return new TimerLogService();
        });

        // 绑定慢查询日志单例
        $this->app->singleton('sql_log', function () {
            return new SQLLogService();
        });

        // 绑定sftp调用日志单例
        $this->app->singleton('sftp_log', function () {
            return new SftpLogService();
        });
    }

    public function boot()
    {

    }

    public function provides()
    {
       return ['api_route_log', 'error_log', 'rpc_log', 'timer_log', 'sql_log', 'sftp_log'];
    }
}
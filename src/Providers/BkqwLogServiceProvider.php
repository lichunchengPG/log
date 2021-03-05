<?php
/**
 * Created by PhpStorm
 * User:lcc
 * Date:2021/2/26
 * Time:14:54
 */

namespace Bkqw\Log\Providers;


use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class BkqwLogServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        // 注册各类型日志服务
        $dirPath      = __DIR__ . '/../Log/Concretes/';
        $preNameSpace = 'Bkqw\Log\Log\Concretes\\';
        if (is_dir($dirPath)) {
            $dirHandle = opendir($dirPath);
            while (false !== ($fileName = readdir($dirHandle))) {
                if ($fileName !== '.' && $fileName !== '..') {
                    $fileName = str_replace('.php', '', $fileName);
                    $ref      = new ReflectionClass($preNameSpace . $fileName);
                    if (!$ref->isAbstract()) {
                        $instance  = $ref->newInstance();
                        $aliasName = $instance->getAliasName();
                        $this->app->singleton($aliasName, function () use ($instance) {
                            return $instance;
                        });
                    }
                }
            }
        }
    }

    public function boot()
    {

    }

    public function provides()
    {
        return ['api_route_log', 'error_log', 'rpc_log', 'timer_log', 'sql_log', 'sftp_log'];
    }
}
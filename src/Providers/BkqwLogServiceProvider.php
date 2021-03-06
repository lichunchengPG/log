<?php
/**
 * Created by PhpStorm
 * User:lcc
 * Date:2021/2/26
 * Time:14:54
 */

namespace Bkqw\Log\Providers;


use Bkqw\Log\Middleware\ApiRouteLog;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class BkqwLogServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $routeMiddleware = [
       'api_log' => ApiRouteLog::class,
    ];


    /**
     * Boot the service provider.
     */
    public function boot()
    {
        // 注册发布资源
        $this->registerPublishing();
    }

    /**
     * 注册服务
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public function register()
    {
        // 注册路由中间件
        $this->registerRouteMiddleware();

        // 注册各类型日志服务
        $this->registerLogService();
    }

    /**
     * 注册发布资源
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config' => base_path('config')
            ], 'bkqw-log-config');
            $this->publishes([
                __DIR__ . '/../../database/migrations' => base_path('database/migrations')
            ], 'bkqw-log-migrations');
        }
    }


    /**
     * 路由中间件注册.
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function registerRouteMiddleware(): void
    {
        $router = $this->app->make('router');

        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
    }


    /**
     * 注册各类型日志服务
     * @throws \ReflectionException
     */
    protected function registerLogService(): void
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

}
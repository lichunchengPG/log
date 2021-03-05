<?php
/**
 * Created by PhpStorm
 * User:lcc
 * Date:2021/3/2
 * Time:14:19
 */


return [
    // 服务绑定的日志类型开关
    'log_toggle'          => [
        'api_route_log' => true,
        'error_log'     => true,
        'rpc_log'       => true,
        'timer_log'     => true,
        'sql_log'       => true,
        'sftp_log'      => true,
    ],

    // 定义长sql时间 ms
    'long_sql_time'       => 1,

    // 日志驱动
    'log_driver'          => env('BKQW_LOG_DRIVER', 'database'), // 日志驱动 数据库：database、 文件：file

    // 日志记录数据库表信息
    'database'            => [
        'connection' => 'mysql',
        'log_table'  => 'system_log'  // 表名
    ],

    // 是否开启异步记录
    'async_toggle'        => false,

    // 异步队列驱动
    'async_driver'        => 'redis',


    // 是否开启字段验证
    'check_fields_toggle' => false,
    // 验证字段
    'validate_fields'     => [
        'system'        => [
            'log_time' => true, // 日志记录时间
            'content'  => true, // 日志内容
        ],
        'debug'         => [
            'log_time' => true, // 日记记录时间
            'content'  => true, // 日志内容
        ],
        'rpc'           => [
            'tag'                => true,   // 外部标识
            'url'                => true,   // 请求地址
            'method'             => true,   // 请求方法
            'request_params'     => true,   // 请求参数
            'http_response_code' => true,   // http响应状态码
            'response_params'    => true,   // 响应参数
            'memo'               => true,   // 备注
        ],
        'timer'         => [
            'task_id'    => true,   // 执行唯一编号
            'task_tag'   => true,   // 任务标识
            'begin_time' => true,   // 开始执行时间
            'end_time'   => true,   // 结束执行时间
            'cost_time'  => true,   // 耗时
            'memo'       => true,   // 备注
        ],
        'error'         => [
            'log_time' => true,     // 报错时间
            'message'  => true,     // 错误描述
            'trace'    => true,     // 错误追踪
            'memo'     => true,
        ],
        'sql'           => [
            'log_time'  => true,    // 日志记录时间
            'sql'       => true,    // 执行的sql
            'cost_time' => true,    // 执行耗时
            'memo'      => true,    // 备注
        ],
        'api_route_log' => [
            'url'             => true,  // 请求地址
            'method'          => true,  // 请求方法
            'ip'              => true,  // 访问ip
            'request_params'  => true,  // 请求参数
            'response_params' => true,  // 响应参数
            'begin_time'      => true,  // 请求开始时间
            'end_time'        => true,  // 请求结束时间
            'cost_time'       => true,  // 耗时
            'memo'            => true,  // 备注
        ]

    ]
];


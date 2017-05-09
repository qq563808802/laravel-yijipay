<?php

/*
 * This file is part of Commidity
 *
 * (c) Wangzd <wangzhoudong@foxmail.com>
 *
 */

return [
    /**
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,

    //    平台自营模式联调id
    'partnerId' => '20160606020000748137', //商户ID
    'md5Key' => '3e5509cd3ab2c0ca73cc178d274dcd33', //商户Key

    //撮合平台 担保模式
    //	'partnerId' => '20160612020000748352',
    //	'md5Key' => 'fbeb22c3ac9b1928ff175ab6dce70220',

    //网关
    //'gatewayUrl' => "https://api.yiji.com/gateway.html" //生产环境
    'gatewayUrl' => "https://openapi.yijifu.net/gateway.html"	//测试环境
    /**
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('YEEPAY_LOG_LEVEL', 'debug'),
        'file'  => env('YEEPAY_LOG_FILE', storage_path('logs/yeepay.log')),
    ],

];

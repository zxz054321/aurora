<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
return [
    'debug' => false,

    'database' => [
        'eloquent' => false,
        'mysql'    => [
            'prefix'  => '',
            'charset' => 'utf8',
        ],
    ],

    'server' => [
        'listen' => [
            'ip'   => '0.0.0.0',
            'port' => 9501,
        ],

        'config' => [
            'log_file'    => ROOT.'/storage/logs/swoole.log',

            /*
             * 重定向Worker进程的文件系统根目录
             * 此设置可以使进程对文件系统的读写与实际的操作系统文件系统隔离
             */
            'chroot'      => ROOT,

            /*
             * 启用守护进程后
             * 标准输入和输出会被重定向到 log file
             */
            'daemonize'   => 0,

            /*
             * 一个worker进程在处理完超过此数值的任务后将自动退出
             * 这个参数是为了防止PHP进程内存溢出。
             * 只能用于同步阻塞的服务器
             * 如果不希望进程自动退出可以设置为0
             */
            'max_request' => 2000,


            /*
             * 最大允许的连接数
             * 此参数用来设置Server最大允许维持多少个tcp连接
             * 超过此数量后，新进入的连接将被拒绝
             * 最大不得超过操作系统ulimit -n的值
             * 默认值为ulimit -n的值
             */
            //'max_conn'    => 1000,
        ],
    ],
];
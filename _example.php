<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
return [
    'debug'    => true,

    'cache'    => [
        'driver'    => 'file',
        'file'      => [
            'dir' => ROOT.'/storage/framework/cache/',
        ],
        'memcached' => [
            [
                'host'   => '127.0.0.1',
                'port'   => '11211',
                'weight' => '100',
            ],
        ],
    ],

    'database' => [
        'mysql' => [
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'doclib',
        ],
    ],
];
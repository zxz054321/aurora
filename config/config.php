<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
return [
    /*
     * When your application is in debug mode, detailed error messages with
     * stack traces will be shown on every error that occurs within your
     * application. If disabled, nothing is shown.
     */
    'debug'    => false,

    /*
     * Here you may specify the default timezone for your application, which
     * will be used by the PHP date and date-time functions. We have gone
     * ahead and set this to a sensible default for you out of the box.
     */
    'timezone' => 'PRC',

    'database' => [
        /*
         * Enable the Laravel's Eloquent ORM. It is a full database toolkit
         * for PHP, providing an expressive query builder,
         * ActiveRecord style ORM, and schema builder.
         */
        'eloquent' => false,

        'mysql'    => [
            'prefix'  => '',
            'charset' => 'utf8',
        ],
    ],
];
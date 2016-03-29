<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Foundation;

use Phalcon\DiInterface;

/**
 * REAL super global in swoole server progress
 * Be careful!
 * @package App\Foundation
 */
class Super
{
    /**
     * @var DiInterface
     */
    protected static $di;

    protected static $container = [];

    public static function di()
    {
        return self::$di;
    }

    public static function setDi(DiInterface $di)
    {
        self::$di = $di;
    }

    public static function get($name)
    {
        return self::$container[ $name ];
    }

    public static function set($name, $definition)
    {
        self::$container [ $name ] = $definition;
    }
}
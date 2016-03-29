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

    /**
     * @return mixed
     */
    public static function di()
    {
        return self::$di;
    }

    /**
     * @param mixed $di
     */
    public static function setDi(DiInterface $di)
    {
        self::$di = $di;
    }
}
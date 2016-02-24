<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;

use Phalcon\DiInterface;

abstract class Injector
{
    /**
     * @var DiInterface
     */
    protected $di;
    protected $config;

    public function __construct($di, $config = null)
    {
        $this->di     = $di;
        $this->config = $config;
    }

    abstract public function inject();
}
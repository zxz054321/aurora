<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;


abstract class Injector
{
    protected $di, $config;

    public function __construct($di, $config = null)
    {
        $this->di     = $di;
        $this->config = $config;
    }


    abstract public function inject();
}
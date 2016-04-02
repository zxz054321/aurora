<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

use Phalcon\DiInterface;

abstract class ServiceProvider
{
    /**
     * @var DiInterface
     */
    protected $di;
    protected $config;

    public function __construct(DiInterface $di, $config = null)
    {
        $this->di     = $di;
        $this->config = $config;
    }

    public function inject()
    {
        $this->register();

        return $this->di;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    abstract protected function register();
}
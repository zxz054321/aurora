<?php
use App\Foundation\Application;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class MainTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        console()->out('Aurora v'.Application::VERSION);
    }
}

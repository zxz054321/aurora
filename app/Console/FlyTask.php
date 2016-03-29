<?php
use App\Foundation\Server;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class FlyTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        console()->out('Bootstrapping...');

        $ip     = config('server')->listen->ip;
        $port   = config('server')->listen->port;
        $server = new Server($ip, $port);

        console()->out("Lightning listening at http://{$ip}:{$port}/");

        $server->serve();
    }
}

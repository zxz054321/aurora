<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

use App\Foundation\ServiceProvider;

/**
 * Runs only in Swoole server
 * @package App\Providers
 */
class ServerServiceProvider extends ServiceProvider
{
    protected function register()
    {
//        Server::hook(Server::BEFORE_SERVER_START, function () {
//            console()->out(Server::BEFORE_SERVER_START);
//        });
    }
}

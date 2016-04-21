<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

use App\Foundation\ServiceProvider;

/**
 * Runs only in the command line environment
 * @package App\Providers
 */
class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected function register()
    {
        //
    }
}

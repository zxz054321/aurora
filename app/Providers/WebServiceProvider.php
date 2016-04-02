<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

use Phalcon\Mvc\View\Simple;

/**
 * Runs only in web environment
 * @package App\Providers
 */
class WebServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected function register()
    {
        $this->di->set('view', function () {
            $view = new Simple();
            $view->setViewsDir(VIEW_PATH.'/');

            return $view;
        });
    }
}

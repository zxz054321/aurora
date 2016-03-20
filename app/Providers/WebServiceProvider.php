<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

/**
 * Runs only in web environment
 * @package App\Providers
 */
class WebServiceProvider extends ServiceProvider
{
    protected function register()
    {
        $this->di->set('view', function () {
            $view = new \Phalcon\Mvc\View\Simple();
            $view->setViewsDir(VIEW_PATH.'/');

            return $view;
        });
    }
}

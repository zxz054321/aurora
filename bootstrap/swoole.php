<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Providers\AppServiceProvider;
use App\Providers\WebServiceProvider;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

/*
 * Inject Dependencies
 */
Di::setDefault(new Di\FactoryDefault);

$di     = require ROOT.'/bootstrap/app.php';
$config = $di->get('config');

$di = (new AppServiceProvider($di, $config))->inject();
$di = (new WebServiceProvider($di, $config))->inject();

/*
 * Bootstrap app
 */
$app = new Micro();
$app->setDI($di);
$app->setEventsManager($di->get('eventsManager'));

require ROOT.'/app/routes.php';

return $app;
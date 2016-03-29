<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Providers\AppServiceProvider;
use App\Providers\WebServiceProvider;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

require '../bootstrap/autoload.php';

/*
 * Inject Dependencies
 */
Di::setDefault(new Di\FactoryDefault);

/** @var Application $app */
$app = require ROOT.'/bootstrap/app.php';
$di  = $app->di();

$app->registerServiceProviders([
    AppServiceProvider::class,
    WebServiceProvider::class,
]);

/*
 * Bootstrap app
 */
$micro = new Micro();
$micro->setDI($di);
$micro->setEventsManager($di->get('eventsManager'));

require ROOT.'/app/routes.php';

return $micro;
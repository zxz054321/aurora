<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Foundation\Application;
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

$config = $di->get('config');

if ($config->debug) {
    $profiler = new \Fabfuel\Prophiler\Profiler();
    $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\QueryAggregator());
    $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Cache\CacheAggregator());
}

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

$micro->handle();

/*
 * Get profiler
 */
if (!defined('DONT_PROFILE') && config('debug')) {
    $toolbar = new \Fabfuel\Prophiler\Toolbar($profiler);
    $toolbar->addDataCollector(new \Fabfuel\Prophiler\DataCollector\Request());
    echo $toolbar->render();
}
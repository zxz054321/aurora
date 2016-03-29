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
$di = new Di\FactoryDefault;

Di::setDefault($di);

/** @var Application $app */
$app = require ROOT.'/bootstrap/app.php';

$app->setDi();

$debug = $di->get('config')->debug;

if ($debug) {
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
if (!defined('DONT_PROFILE') && $debug) {
    $toolbar = new \Fabfuel\Prophiler\Toolbar($profiler);
    $toolbar->addDataCollector(new \Fabfuel\Prophiler\DataCollector\Request());
    echo $toolbar->render();
}
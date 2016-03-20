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

$di     = require ROOT.'/bootstrap/app.php';
$config = $di->get('config');

if ($config->debug) {
    $profiler = new \Fabfuel\Prophiler\Profiler();
    $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\QueryAggregator());
    $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Cache\CacheAggregator());
}

$di = (new AppServiceProvider($di, $config))->inject();
$di = (new WebServiceProvider($di, $config))->inject();

/*
 * Bootstrap app
 */
$app = new Micro();
$app->setDI($di);
$app->setEventsManager($di->get('eventsManager'));

require ROOT.'/app/routes.php';

$app->handle();

/*
 * Get profiler
 */
if (!defined('DONT_PROFILE') && config('debug')) {
    $toolbar = new \Fabfuel\Prophiler\Toolbar($profiler);
    $toolbar->addDataCollector(new \Fabfuel\Prophiler\DataCollector\Request());
    echo $toolbar->render();
}
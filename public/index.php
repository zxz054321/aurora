<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Foundation\Application;
use App\Providers\AppServiceProvider;
use App\Providers\WebServiceProvider;
use Fabfuel\Prophiler\Aggregator\Cache\CacheAggregator;
use Fabfuel\Prophiler\Aggregator\Database\QueryAggregator;
use Fabfuel\Prophiler\DataCollector\Request;
use Fabfuel\Prophiler\Profiler;
use Fabfuel\Prophiler\Toolbar;
use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

require '../bootstrap/autoload.php';

/*
 * Inject Dependencies
 */
$di = new FactoryDefault;

Di::setDefault($di);

/** @var Application $app */
$app = require ROOT.'/bootstrap/app.php';

$app->setDi();

$debug     = $di->get('config')->debug;
$doProfile = class_exists(Profiler::class);

if ($debug) {
    if ($doProfile) {
        $profiler = new Profiler();
        $profiler->addAggregator(new QueryAggregator());
        $profiler->addAggregator(new CacheAggregator());
    }
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
if (!defined('DONT_PROFILE') && $debug && $doProfile) {
    $toolbar = new Toolbar($profiler);
    $toolbar->addDataCollector(new Request());
    echo $toolbar->render();
}
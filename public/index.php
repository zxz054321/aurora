<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Providers\AppServiceProvider;
use App\Providers\WebServiceProvider;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

require '../bootstrap/autoload.php';

Di::setDefault(new Di\FactoryDefault);
$di = require ROOT.'/bootstrap/app.php';
$di = (new AppServiceProvider($di, $di->get('config')))->inject();
$di = (new WebServiceProvider($di, $di->get('config')))->inject();

$app = new Micro();
$app->setDI($di);

require ROOT.'/app/routes.php';

$app->handle();
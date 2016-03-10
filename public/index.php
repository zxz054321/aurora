<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Injectors\AppInjector;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

require '../bootstrap/autoload.php';

$di = require '../bootstrap/app.php';
$di = (new AppInjector($di, $di->get('config')))->inject();

$app = new Micro();
$app->setDI($di);

require ROOT.'/app/routes.php';

$app->handle();
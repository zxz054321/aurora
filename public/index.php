<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Injectors\AppInjector;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

require '../bootstrap/app.php';

$di = Di::getDefault();
$di = (new AppInjector($di, $di['config']))->inject();

$app = new Micro();
$app->setDI($di);

require ROOT.'/app/routes.php';

$app->handle();
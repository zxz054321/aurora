<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Injectors\AppInjector;
use App\Injectors\CliInjector;
use Phalcon\Mvc\Micro;

require '../bootstrap.php';

//create app instance
$app = new Micro();

$app['config'] = $config;

(new AppInjector($app, $config))->inject();

require ROOT.'/app/routes.php';

$app->handle();
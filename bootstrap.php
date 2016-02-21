<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Config;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Mvc\Micro;

define('ROOT', __DIR__);

require ROOT.'/vendor/autoload.php';

//load app config
$config = new Config(array_replace_recursive(
    require ROOT.'/config.php',
    require ROOT.'/_'
));

//global error handler & logger
register_shutdown_function(function () use ($config) {
    if (!is_null($error = error_get_last())) {
        if (!$config->debug && $error['type'] >= E_NOTICE) {
            return;
        }

        $logger = new FileAdapter(ROOT.'/logs/error.log');

        $logger->error(print_r($error, true));
    }
});

// Creates the autoloader
$loader = new \Phalcon\Loader();

//Register some namespaces
$loader->registerNamespaces([
    'App' => ROOT.'/app/',
]);

// register autoloader
$loader->register();

//create app instance
$app = new Micro();

$app['config'] = $config;

require ROOT.'/app/injector.php';

return $app;
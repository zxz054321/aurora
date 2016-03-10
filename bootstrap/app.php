<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Config;
use Phalcon\Di;
use Phalcon\Logger\Adapter\File as FileAdapter;

define('ROOT', realpath(__DIR__.'/../'));

require ROOT.'/vendor/autoload.php';

//load app config
$config = new Config(array_replace_recursive(
    require ROOT.'/config.php',
    require ROOT.'/_'
));

$di = new Di\FactoryDefault();
$di->set('config', $config);
Di::setDefault($di);

//global error handler & logger
register_shutdown_function(function () use ($config) {
    if (!is_null($error = error_get_last())) {
        if (!$config->debug && $error['type'] >= E_NOTICE) {
            return;
        }

        $logger = new FileAdapter(ROOT.'/storage/logs/error.log');

        $logger->error(print_r($error, true));
    }
});

//Report errors in debug mode only
if (!$config->debug) {
    error_reporting(0);
}

// Creates the autoloader
$loader = new \Phalcon\Loader();

//Register some namespaces
$loader->registerNamespaces([
    'App' => ROOT.'/app/',
]);

// register autoloader
$loader->register();

return $loader;
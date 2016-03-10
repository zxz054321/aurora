<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Config;
use Phalcon\Di;
use Phalcon\Logger\Adapter\File as FileAdapter;


// Load config first =======================
$config = new Config(array_replace_recursive(
    require ROOT.'/config.php',
    require ROOT.'/_'
));


// Set up DI ===================
$di = new Di\FactoryDefault();
$di->set('config', $config);

Di::setDefault($di);


// Global error handler & logger ======================
register_shutdown_function(function () use ($config) {
    if (!is_null($error = error_get_last())) {
        if (!$config->debug && $error['type'] >= E_NOTICE) {
            return;
        }

        $logger = new FileAdapter(ROOT.'/storage/logs/error.log');

        $logger->error(print_r($error, true));
    }
});

// Report errors in debug mode only
if (!$config->debug) {
    error_reporting(0);
}


return $di;
<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

if (!defined('ROOT')) {
    define('ROOT', realpath(__DIR__.'/../'));
}

require ROOT.'/vendor/autoload.php';

// Register some namespaces ============
$loader = new \Phalcon\Loader();
$loader->registerNamespaces([
    'App' => ROOT.'/app/',
]);
$loader->register();

return $loader;
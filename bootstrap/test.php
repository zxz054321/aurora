<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

$loader = require 'app.php';

$loader->registerDirs([
    ROOT.'/tests/',
]);

ini_set('display_errors', 1);
error_reporting(E_ALL);
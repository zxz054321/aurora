<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

$app = require '../bootstrap.php';

require ROOT.'/app/routes.php';

$app->handle();
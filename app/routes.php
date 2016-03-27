<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$appController = new MicroCollection();
$appController->setHandler(App\Controllers\AppController::class);
$appController->get('/', 'hi');

$app->mount($appController);

$app->notFound(function () {
    return abort(404);
});
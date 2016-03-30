<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$appController = new MicroCollection();
$appController->setHandler(App\Controllers\AppController::class, true);
$appController->get('/', 'hi');

/** @noinspection PhpUndefinedVariableInspection */
$micro->mount($appController);

$micro->notFound(function () {
    return abort(404);
});
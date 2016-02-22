<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$appController = new MicroCollection();
$appController->setHandler(App\Controllers\AppController::class, true);
$appController->get('/', 'hi');

$app->mount($appController);

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});
<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

define('CONTROLLERS', 'App\\Controllers\\');

$app->get('/', CONTROLLERS.'AppController::hi');

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});
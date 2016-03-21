<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->dropIfExists('users');

Manager::schema()->create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    /** @noinspection PhpUndefinedMethodInspection */
    $table->string('email')->unique();
    $table->string('password', 60);
    $table->rememberToken();
    $table->timestamps();
});
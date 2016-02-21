<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
namespace App\Controllers;

use Phalcon\Mvc\Controller;

class AppController extends Controller
{

    public function hi()
    {
        echo "<h1>Hi, I'm Lightning!</h1>";
    }

}
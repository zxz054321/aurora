<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Controllers;

use App\Foundation\Application;

class AppController extends Controller
{
    public function hi()
    {
        echo $this->view->render('welcome', [
            'version' => Application::VERSION,
            'motto'   => 'If I have seen further, it is by standing on the shoulders of giants.',
            'author'  => 'Isaac Newton',
        ]);
    }
}
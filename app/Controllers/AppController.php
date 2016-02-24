<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Controllers;

class AppController extends Controller
{
    public function hi()
    {
        require ROOT.'/resources/views/welcome.php';
    }
}
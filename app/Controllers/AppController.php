<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Controllers;

class AppController extends Controller
{
    public function hi()
    {
        return <<<EOF
If I have seen further, it is by standing on the shoulders of giants.
by Isaac Newton

EOF;
    }
}
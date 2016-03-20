<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Controllers;

class AppController extends Controller
{
    public function hi()
    {
        $h = date('H');

        if ($h < 12) {
            $text = 'morning';
        } else {
            if ($h < 18) {
                $text = 'afternoon';
            } else {
                $text = 'evening';
            }
        }

        echo $this->view->render('welcome', ['greet' => $text]);
    }
}
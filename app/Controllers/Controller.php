<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Controllers;

use Phalcon\Mvc\Controller as Base;

class Controller extends Base
{
    public function initialize()
    {
        //
    }

    public function onConstruct()
    {
        //
    }

    protected function dontProfile()
    {
        define('DONT_PROFILE', true);
    }

    protected function json($content)
    {
        $this->response->setContentType('application/json');

        $this->response->setContent(json_encode($content));

        return $this->response;
    }
}
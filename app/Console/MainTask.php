<?php

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class MainTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        console()->out('Lightning Console v'.VERSION);
    }
}

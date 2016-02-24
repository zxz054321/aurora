<?php

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class MigrateTask extends \Phalcon\CLI\Task
{
    protected $migrations = [
        //'migration',
    ];

    public function mainAction()
    {
        foreach ($this->migrations as $migration) {
            require ROOT."/database/migrations/$migration.php";
        }
    }
}

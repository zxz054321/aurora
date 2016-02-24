<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;
use Illuminate\Database\Capsule\Manager as Capsule;

class CliInjector extends Injector
{
    public function inject()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $this->config->database->mysql->host,
            'database'  => $this->config->database->mysql->dbname,
            'username'  => $this->config->database->mysql->username,
            'password'  => $this->config->database->mysql->password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();

        $this->di->set('eloquent',$capsule,true);

        return $this->di;
    }

}

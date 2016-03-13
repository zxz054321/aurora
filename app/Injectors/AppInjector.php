<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Backend\Libmemcached as BackMemCached;
use Phalcon\Cache\Frontend\Data as FrontData;
use Phalcon\Cache\Frontend\Output as FrontOutput;
use Phalcon\Db\Adapter\Pdo\Mysql;

class AppInjector extends Injector
{
    protected function register()
    {
        $this->registerCache();
        $this->registerDatabase();
    }

    protected function registerCache()
    {
        $this->di->set('cache', function () {
            $config = config('cache');

            switch ($config->driver) {
                case 'memcached':
                    $cache = new BackMemCached(
                        new FrontData(["lifetime" => 7 * 24 * 3600]),
                        ["servers" => $config->memcached->toArray()]
                    );
                    break;
                case 'file':
                    $cache = new BackFile(
                        new FrontOutput(["lifetime" => 6 * 3600]),
                        ['cacheDir' => $config->file->dir]
                    );
                    break;
                default:
                    throw new Exception('no cache driver defined.');
            }

            return $cache;
        });
    }

    protected function registerDatabase()
    {
        $config = config('database');

        $this->di->set('db', function () use ($config) {
            $connection = new Mysql($config->mysql->toArray());

            return $connection;
        });

        if ($config->eloquent) {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $config->mysql->host,
                'database'  => $config->mysql->dbname,
                'username'  => $config->mysql->username,
                'password'  => $config->mysql->password,
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]);

            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            $this->di->set('eloquent', $capsule, true);
        }
    }
}

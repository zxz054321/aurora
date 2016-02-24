<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;

use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Backend\Libmemcached as BackMemCached;
use Phalcon\Cache\Frontend\Data as FrontData;
use Phalcon\Cache\Frontend\Output as FrontOutput;
use Phalcon\Db\Adapter\Pdo\Mysql;

class AppInjector extends Injector
{
    public function inject()
    {
        $app    = $this->di;
        $config = $this->config;

        $app['cache'] = function () use ($app, $config) {
            switch ($config->cache->driver) {
                case 'memcached':
                    $cache = new BackMemCached(
                        new FrontData(["lifetime" => 7 * 24 * 3600]),
                        ["servers" => $config->cache->memcached->toArray()]
                    );
                    break;
                case 'file':
                    $cache = new BackFile(
                        new FrontOutput(["lifetime" => 6 * 3600]),
                        ['cacheDir' => $config->cache->file->dir]
                    );
                    break;
                default:
                    throw new Exception('no cache driver defined.');
            }

            return $cache;
        };

        $app['store'] = function () use ($config) {
            $connection = new Mysql($config->database->mysql->toArray());

            return $connection;
        };

        return $app;
    }

}

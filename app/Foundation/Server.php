<?php

namespace App\Foundation;

use App\Providers\AppServiceProvider;
use App\Providers\ServerServiceProvider;
use App\Providers\WebServiceProvider;
use Phalcon\Di;
use Phalcon\Mvc\Micro;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class Server
{
    const BEFORE_SERVER_START = 'before_server_start';

    protected static $hooks = [];

    /**
     * @var Application
     */
    protected $app;

    protected $debug, $ip, $port;

    public function __construct($ip, $port)
    {
        $this->app   = require ROOT.'/bootstrap/app.php';
        $this->debug = config('debug');
        $this->ip    = $ip;
        $this->port  = $port;

        Super::setDi(
            (new ServerServiceProvider(new Di, config()))->inject()
        );
    }

    public static function hook($event, callable $func)
    {
        self::$hooks[ $event ][] = $func;
    }

    public function serve()
    {
        $http   = new \swoole_http_server(
            $this->ip,
            $this->port,
            config('server')->mode
        );
        $config = config('server')->config->toArray();

        //使用超全局变量在异步非阻塞的模式下可能存在不可重入问题
        $http->setGlobal(HTTP_GLOBAL_ALL);

        $http->set($config);
        $http->on('request', [$this, 'onRequest']);

        $this->runHooks(static::BEFORE_SERVER_START);

        $http->start();
    }

    protected function runHooks($event)
    {
        if (!isset(self::$hooks[ $event ])) {
            return;
        }

        $list = self::$hooks[ $event ];

        foreach ($list as $hook) {
            $hook();
        }
    }

    /**
     * Never call this function manually
     * TODO file_get_contents('php://input') is not supported yet
     * @param \swoole_http_request $request
     * @param \swoole_http_response $response
     */
    public function onRequest($request, $response)
    {
        if ($this->debug) {
            $time   = date('H:i:s');
            $method = $request->server['request_method'];

            console()->out("[$time] $method ".$request->server['request_uri']);
        }

        Response::setInstance($response);

        try {
            $di = new Di\FactoryDefault;

            Di::setDefault($di);
            $this->app->setDi($di);

            $this->app->registerServiceProviders([
                AppServiceProvider::class,
                WebServiceProvider::class,
            ]);

            $micro = new Micro();
            $micro->setDI($di);
            $micro->setEventsManager($di->get('eventsManager'));

            require ROOT.'/app/routes.php';

            /** @var Response $res */
            $res = $micro->handle($request->server['request_uri']);

            if ($res instanceof Response) {
                $res->end();
            } else {
                is_string($res) ?
                    $response->end($res) :
                    $response->end();
            }
        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
            echo $e->getTraceAsString().PHP_EOL;
        }
    }
}

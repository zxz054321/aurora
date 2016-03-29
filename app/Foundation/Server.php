<?php

namespace App\Foundation;

use App\Providers\ServerServiceProvider;
use Phalcon\Di;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class Server
{
    const BEFORE_SERVER_START = 'before_server_start';

    protected static $hooks = [];

    protected $debug, $ip, $port;

    public function __construct($ip, $port)
    {
        $this->debug = config('debug');
        $this->ip    = $ip;
        $this->port  = $port;

        $di = (new ServerServiceProvider(new Di, config()))->inject();

        Super::setDi($di);
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

        try {
            Response::setInstance($response);

            $app = require ROOT.'/bootstrap/swoole.php';

            /** @var Response $res */
            $res = $app->handle($request->server['request_uri']);

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

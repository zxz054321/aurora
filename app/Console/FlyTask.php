<?php
use Phalcon\Config;
use Phalcon\Http\Response;
use Phalcon\Mvc\Micro;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class FlyTask extends \Phalcon\CLI\Task
{
    protected $debug, $ip, $port;

    public function mainAction()
    {
        $this->bootstrap();
        $this->serve();
    }

    protected function bootstrap()
    {
        console()->out('Bootstrapping...');

        config()->merge(new Config(
            require CONFIG_PATH.'/server.php'
        ));

        $this->debug = config('debug');
        $this->ip    = config('server')->listen->ip;
        $this->port  = config('server')->listen->port;
    }

    protected function serve()
    {
        console()->out("Lightning listening at http://{$this->ip}:{$this->port}");

        $http = new swoole_http_server($this->ip, $this->port);

        //使用超全局变量在异步非阻塞的模式下可能存在不可重入问题
        $http->setGlobal(HTTP_GLOBAL_ALL);
        $http->set(config('server')->config->toArray());
        $http->on('request', [$this, 'onRequest']);

        $http->start();
    }

    /**
     * @param swoole_http_request $request
     * @param swoole_http_response $response
     */
    public function onRequest($request, $response)
    {
        if ($this->debug) {
            $this->debug('Request uri= '.$request->server['request_uri']);
        }

        try {
            $app = require ROOT.'/bootstrap/swoole.php';

            /** @var Response $ret */
            $ret = $app->handle($request->server['request_uri']);

            if (is_object($ret)) {
                $response->end($ret->getContent());
            } else {
                if (is_string($ret)) {
                    $response->end($ret);
                } else {
                    $response->end();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage().PHP_EOL;
            echo $e->getTraceAsString().PHP_EOL;
        }
    }

    protected function debug($msg)
    {
        console()->out('[DEBUG] '.$msg);
    }
}

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

    /*
     * Worker进程不得共用同一个Redis或MySQL等网络服务客户端，Redis/MySQL创建连接的相关代码可以放到onWorkerStart回调函数中
     * 在swoole_server中，应当在onWorkerStart中创建连接对象
在swoole_process中，应当在swoole_process->start后，子进程回调函数中创建连接对象
    //必须在onWorkerStart回调中创建redis/mysql连接
$serv->on('workerstart', function($serv, $id) {
    $redis = new redis;
    $redis->connect('127.0.0.1', 6379);
    $serv->redis = $redis;
});
     */
    public function mainAction()
    {
//        chroot(ROOT);

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

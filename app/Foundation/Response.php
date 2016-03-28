<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Foundation;

use Phalcon\Di;
use Phalcon\Http\Response as Base;

class Response extends Base
{
    /**
     * @var \swoole_http_response
     */
    protected static $swooleResponse;

    public function __construct($content = null, $code = null)
    {
        if (!static::$swooleResponse) {
            throw new \Exception('Initialize swoole response first!');
        }

        if ($code) {
            static::$swooleResponse->status($code);
        }

        parent::__construct($content, $code);
    }

    public static function setInstance($response)
    {
        static::$swooleResponse = $response;
    }

    public function setStatusCode($code, $message = null)
    {
        static::$swooleResponse->status($code);

        parent::setStatusCode($code, $message);

        return $this;
    }

    public function send()
    {
        if ($this->_sent) {
            throw new Base\Exception('Response was already sent');
        }

        if ($this->_headers) {
            /** @noinspection PhpUndefinedMethodInspection */
            $headers = $this->_headers->toArray();

            foreach ($headers as $key => $value) {
                static::$swooleResponse->header($key, $value);
            }
        }

        $this->_sent = true;

        return $this;
    }

    public function end()
    {
        static::$swooleResponse->end($this->getContent());
    }
}
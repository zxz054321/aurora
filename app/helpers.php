<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
use Phalcon\Config;
use Phalcon\Di;
use Phalcon\Http\Response;

/**
 * Get the available container instance.
 *
 * @param  string $make
 * @param  array $parameters
 * @return mixed|Di
 * @throws Phalcon\Di\Exception
 */
function app($make = null, array $parameters = null)
{
    $di = Di::getDefault();

    if (is_null($make)) {
        return $di;
    }

    return $di->get($make, $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param  string $key
 * @return mixed|Config
 */
function config($key = null)
{
    if (is_null($key)) {
        return app('config');
    }

    return app('config')->get($key);
}

/**
 * Return an Http Exception
 *
 * @param  int $code
 * @param  string $message
 * @return Response
 */
function abort($code, $message = '')
{
    /** @var Response $response */
    $response = app('response');

    if ($code == 404) {
        $response->setStatusCode($code, 'Not Found');
        $response->setContent($message ?: 'This is crazy, but this page was not found!'.PHP_EOL);
    } else {
        $response->setStatusCode($code);

        if ($message) {
            $response->setContent($message);
        }
    }

    return $response;
}

/**
 * Get / set the specified session value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param  array|string $key
 * @param  mixed $default
 * @return mixed
 */
function session($key = null, $default = null)
{
    if (is_null($key)) {
        return app('session');
    }

    if (is_array($key)) {
        return app('session')->set(key($key), current($key));
    }

    return app('session')->get($key, $default);
}
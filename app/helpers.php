<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */
use Phalcon\Config;
use Phalcon\Di;

/**
 * Get the available container instance.
 *
 * @param  string $make
 * @param  array $parameters
 * @return mixed|Di
 */
function app($make = null, $parameters = null)
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
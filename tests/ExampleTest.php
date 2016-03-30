<?php
use Phalcon\Http\Client\Request;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class ExampleTest extends TestCase
{
    public function testShouldSeeWelcome()
    {
        $port     = config('server')->listen->port;
        $provider = Request::getProvider();
        $response = $provider->get("http://localhost:$port/");

        $this->assertEquals(true,
            str_contains($response->body,
                'If I have seen further, it is by standing on the shoulders of giants.'
            )
        );
    }
}

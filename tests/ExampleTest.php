<?php
use Phalcon\Http\Client\Request;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;

/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class ExampleTest extends TestCase
{
    public function testWelcome()
    {
        $provider = Request::getProvider();
        $response = $provider->get('http://localhost/');

        $this->assertEquals(true,
            str_contains($response->body, 'I\'m Lightning!')
        );
    }
}

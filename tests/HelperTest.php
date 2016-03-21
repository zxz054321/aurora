<?php
use Phalcon\Config;
use Phalcon\DiInterface;


/**
 * Author: Abel Halo <zxz054321@163.com>
 */
class HelperTest extends TestCase
{
    public function testApp()
    {
        $this->assertInstanceOf(DiInterface::class, app());
    }

    public function testConfig()
    {
        $this->assertInstanceOf(Config::class, config());
        $this->assertEquals(true, is_bool(config('debug')));
        /** @noinspection PhpUndefinedFieldInspection */
        $this->assertEquals(true, is_bool(config('database')->eloquent));
    }

    public function testAbort()
    {
        $this->assertInstanceOf(Phalcon\Http\Response::class, abort(404));
    }

    public function testSession()
    {
        $key = 'test'.time();
        $val = md5($key);
        session([$key => $val]);

        $this->assertInstanceOf(Phalcon\Session\Adapter::class, session());
        $this->assertEquals($val, session($key));
        $this->assertEquals(null, session($key.'none'));
        $this->assertEquals('abc', session($key.'none', 'abc'));
    }
}

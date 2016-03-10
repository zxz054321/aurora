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

        $this->assertInstanceOf(Config::class, config());
        $this->assertEquals(true, is_bool(config('debug')));
        $this->assertEquals(true, is_bool(config('database')->eloquent));
    }
}

<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Injectors\AppInjector;
use Phalcon\DI;
use Phalcon\Mvc\Micro;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class TestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp()
    {
        $di = (new AppInjector(app(), config()))->inject();

        // Set the URL
        $di->set(
            'url',
            function () {
                $url = new Url();
                $url->setBaseUri('/');

                return $url;
            }
        );

        $di->set(
            'escaper',
            function () {
                return new Escaper();
            }
        );

        $this->di      = $di;
        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
        }
    }
}
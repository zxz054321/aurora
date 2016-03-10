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
     * @var Micro
     */
    protected $app;

    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp(\Phalcon\DiInterface $di = null, \Phalcon\Config $config = null)
    {
        $di = Di::getDefault();
        $di = (new AppInjector($di, $di['config']))->inject();

        //create app instance
        $app = new Micro();
        $app->setDI($di);

        require ROOT.'/app/routes.php';

        $this->app = $app;

        // get any DI components here. If you have a config, be sure to pass it to the parent
        parent::setUp($di);

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
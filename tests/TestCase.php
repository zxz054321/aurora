<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

use App\Providers\AppServiceProvider;
use Phalcon\Config;
use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Escaper;
use Phalcon\Loader;
use Phalcon\Mvc\Application as PhApplication;
use Phalcon\Mvc\Dispatcher as PhDispatcher;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Model\Manager as PhModelManager;
use Phalcon\Mvc\Url;
use Phalcon\Test\FunctionalTestCase;

abstract class TestCase extends FunctionalTestCase
{
    private $_loaded = false;

    public function setUp()
    {
        $this->checkExtension('phalcon');

        $this->bootstrap();

        $this->setupUnitTest();
        $this->setupModelTest();
        $this->setupFunctionalTest();

        $this->_loaded = true;
    }

    protected function bootstrap()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $loader = new Loader();
        $loader->registerDirs([
            ROOT.'/tests/',
        ]);

        // Reset the DI container
        Di::reset();
        Di::setDefault(new Di\FactoryDefault);

        $this->di = require ROOT.'/bootstrap/app.php';
        $this->di = (new AppServiceProvider($this->di, config()))->inject();
    }

    protected function setupUnitTest()
    {
        // Set the URL
        $this->di->set(
            'url',
            function () {
                $url = new Url();
                $url->setBaseUri('/');

                return $url;
            }
        );

        $this->di->set(
            'escaper',
            function () {
                return new Escaper();
            }
        );
    }

    protected function setupModelTest()
    {
        // Set Models manager
        $this->di->set(
            'modelsManager',
            function () {
                return new PhModelManager();
            }
        );

        // Set Models metadata
        $this->di->set(
            'modelsMetadata',
            function () {
                return new PhMetadataMemory();
            }
        );
    }

    protected function setupFunctionalTest()
    {
        // Set the dispatcher
        $this->di->setShared(
            'dispatcher',
            function () {
                $dispatcher = new PhDispatcher();
                $dispatcher->setControllerName('test');
                $dispatcher->setActionName('empty');
                $dispatcher->setParams([]);

                return $dispatcher;
            }
        );

        $this->application = new PhApplication($this->di);
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
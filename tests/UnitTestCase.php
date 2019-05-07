<?php
/*
 * Created Date: Sunday May 5th 2019
 * Author: Pangxiaobo
 * Last Modified: Sunday May 5th 2019 6:07:08 pm
 * Modified By: the developer formerly known as Pangxiaobo at <10846295@qq.com>
 * Copyright (c) 2019 Pangxiaobo
 */

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use \Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Cache\Backend\Redis as BackRedis;
use Phalcon\Cache\Frontend\Data as FrontData;

abstract class UnitTestCase extends PhalconTestCase
{

/**
 * @var \Voice\Cache
 */
    protected $_cache;

    /**
     * @var \Phalcon\Config
     */
    protected $_config;

    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp(Phalcon\DiInterface $di = null, Phalcon\Config $config = null)
    {
        global $config;

        if (is_null($config)) {
            $this->_config = include __DIR__ . '/../api/config/config.php';
        } else {
            $this->_config = $config;
        }

        // Load any additional services that might be required during testing
        $di = new FactoryDefault();
        Di::reset();

        $di->set('db', function () use ($config) {
            return new \Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());
        });
        
        $di->set('modelsManager', function () {
            return new ModelsManager();
        }, true);

        $di->set("config", function () use ($config) {
            return $config;
        });
        
        $di->setShared('serviceCache', function () use ($config) {
            $frontCache = new FrontData([
                'lifetime' => 2592000,
            ]);
            return new BackRedis($frontCache,(array) $config->redisCache);
        });

        Di::setDefault($di);
        $this->setDi($di);

       // parent::setUp($di, $config);
        $this->_loaded = true;
    }

    /**
     * 重置testcase环境
     *
     * @return void
     */
    protected function tearDown()
    {
        $di = $this->getDI();
        $di::reset();
        parent::tearDown();
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

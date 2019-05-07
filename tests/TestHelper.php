<?php
/*
 * Created Date: Sunday May 5th 2019
 * Author: Pangxiaobo
 * Last Modified: Sunday May 5th 2019 5:57:13 pm
 * Modified By: the developer formerly known as Pangxiaobo at <10846295@qq.com>
 * Copyright (c) 2019 Pangxiaobo
 */

use Phalcon\DI;
use Phalcon\DI\FactoryDefault;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);
define('PATH_INCUBATOR', __DIR__ . '/../vendor/phalcon/incubator/');
define('PATH_CONFIG', __DIR__ . '/../api/config/config.php');
define('PATH_MODELS', __DIR__ . '/../api/models/');
define('PATH_CONTROLLERS', __DIR__ . '/../api/controllers/');
define('PATH_SERVICES', __DIR__ . '/../api/services/');

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// use the application autoloader to autoload the classes
// autoload the dependencies found in composer
$loader = new \Phalcon\Loader();

$loader->registerDirs(array(
    ROOT_PATH,
    PATH_CONFIG,
    PATH_MODELS,
    PATH_SERVICES,
    PATH_CONTROLLERS,
));

$loader->registerNamespaces(array(
    'Phalcon' => PATH_INCUBATOR . 'Library/Phalcon/',
));

$loader->register();

$config = include PATH_CONFIG;

$di = new FactoryDefault();

Di::reset();

// add any needed services to the DI here
/**
 * Database connection is created based in the parameters defined in the configuration file
 */

$di->set('db', function () use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());
}, true);

Di::setDefault($di);

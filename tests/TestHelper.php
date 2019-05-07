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

// 使用autoloader加载应用中的类，autoload依赖可以在composer vendor目录下找到
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

//这里我们注入一些需要用到的service服务，例如：db
$di->set('db', function () use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());
}, true);

Di::setDefault($di);

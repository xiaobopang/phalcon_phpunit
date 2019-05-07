## 简介
 
 这是一个基于Phalcon框架的单元测试demo小教程，希望对初次编写单元测试的童鞋有所帮助。

 
### 前提

```
   1、在开始之前先假定你已经使用过Phalcon这个框架，对其有一定基础认知。
   2、其次你对composer包依赖管理有一定的了解
```

### 快速开始

````
    1.安装PHPUnit

        以下为Linux操作环境：

        $ wget wget -O phpunit https://phar.phpunit.de/phpunit-8.phar

        $ sudo mv phpunit-8.phar /usr/local/bin/phpunit

        $ sudo chmod +x /usr/local/bin/phpunit

        $ phpunit --version

        如果输出结果如下，则表明你已经安装成功：
````

![执行结果](./test.png)

[PHPUnit](https://github.com/sebastianbergmann/phpunit) 👈点击左侧"PHPUnit"

```
    2、通过composer来引入相关测试组件，首先进入你的项目根目录执行一下命令：

        1）composer require --dev phpunit/phpunit ^8
        2）composer require phalcon/incubator
        3）以上安装结束后，在你的项目根目录下创建tests文件夹，并进入到tests文件夹下
        4）在tests文件夹下新建phpunit.xml，格式如下：

        <?xml version="1.0" encoding="UTF-8"?>
        <phpunit bootstrap="./TestHelper.php"
                backupGlobals="false"
                backupStaticAttributes="true"
                verbose="false"
                colors="true"
                cacheResult="true"
                convertErrorsToExceptions="true"
                convertNoticesToExceptions="true"
                convertWarningsToExceptions="true"
                mapTestClassNameToCoveredClassName="false"
                processIsolation="false"
                stopOnFailure="false"
                syntaxCheck="true">

            <testsuites>
                <testsuite name="Phalcon - Testsuite">
                    <!--仅当php版本不低于7.0的时候才执行单元测试-->
                    <directory suffix="Test.php" phpVersion="7.0" phpVersionOperator=">=">./</directory>
                    <file phpVersion="7.0" phpVersionOperator=">=">./Test/UnitCaseTest.php</file>
                </testsuite>
            </testsuites>
            <!--定义PHP变量-->
            <php>
                    <includePath>.</includePath>
                    <get  name="name" value="jack"/>
                    <post name="username" value="jack"/>
                    <post name="password" value="9cbf8a4dcb8e30682b927f352d6559a0"/>
            </php>
            <!--代码覆盖率白名单-->
            <filter>
                <whitelist processUncoveredFilesFromWhitelist="true">
                    <directory suffix=".php">./</directory>
                    <file>./UnitCaseTest.php</file>
                    <exclude>
                        <directory suffix=".php">./</directory>
                        <file>./UnitCaseTest.php</file>
                    </exclude>
                </whitelist>
            </filter>
        </phpunit>

        5）紧接着在你的tests文件夹下新建一个TestHelper.php，其内容如下：

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


```

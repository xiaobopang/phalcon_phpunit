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

````
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

````

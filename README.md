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
    2、通过composer来引入相关测试组件
    首先，进入你的项目根目录执行一下命令：

        1）composer require --dev phpunit/phpunit ^8
        2）composer require phalcon/incubator




````

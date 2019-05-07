<?php
/*
 * Created Date: Monday May 6th 2019
 * Author: Pangxiaobo
 * Last Modified: Monday May 6th 2019 4:21:13 pm
 * Modified By: the developer formerly known as Pangxiaobo at <10846295@qq.com>
 * Copyright (c) 2019 Pangxiaobo
 */
namespace Test;

class TestController extends \ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        self::$logStatus = 1;
    }
    public function hello($name)
    {
        echo "hello," . $name;
    }
}

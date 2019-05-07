<?php
/*
 * Created Date: Monday May 6th 2019
 * Author: Pangxiaobo
 * Last Modified: Monday May 6th 2019 2:24:53 pm
 * Modified By: the developer formerly known as Pangxiaobo at <10846295@qq.com>
 * Copyright (c) 2019 Pangxiaobo
 */

namespace Test;
/**
 * Class UnitCaseTest
 */
class CaseTest extends \UnitTestCase
{
    /**
     * 控制器取值测试
     * @return void
     */
    public function testController()
    {
        $logStatus = TestController::$logStatus;
        $this->assertEquals($logStatus, 1, "获取到控制器的logStatus=" . $logStatus);
    }

    /**
     * 输出测试
     *
     * @return void
     */
    public function testHello()
    {
        $name = $_GET["name"];
        $test = new TestController();
        $test->hello($name);
        $this->expectOutputString('hello,jack');
    }

    /**
     * 模型类测试
     *
     * @return void
     */
    public function testModel()
    {
        $testModel = new TestModel();
        $testModel->source = "Test";
        $testModel->listFields = ["id", "user", "age"];
        $listInfo = $testModel->retrieve(0, 3);
        // 读出的条目数量是否正确
        $this->assertEquals(
            count($listInfo["List"]),
            3,
            "查询数据和预期不符"
        );
    }

    /**
     * 获取参数测试
     *
     * @return void
     */
    public function testTest()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $this->assertEquals($username, 'jack', "用户名有误");
        $this->assertEquals($password, '9cbf8a4dcb8e30682b927f352d6559a0', "密码有误");
    }
}

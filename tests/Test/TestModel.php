<?php
/*
 * Created Date: Monday May 6th 2019
 * Author: Pangxiaobo
 * Last Modified: Monday May 6th 2019 4:21:13 pm
 * Modified By: the developer formerly known as Pangxiaobo at <10846295@qq.com>
 * Copyright (c) 2019 Pangxiaobo
 */
namespace Test;

class TestModel extends \BaseModel
{
    /**
     * 
     * @var string @majorID
     */
    protected $majorID = "ID";
    
    public $insertFields = [];

    /*
     * 列表用的字段
     * 1. 本表要展示的字段
     * 2. 和其他表关联展示的字段
     */
    public $listFields =[];

    /**
     * 查看详情用的字段
     * 1. 本表要展示的字段
     * 2. 和其他表关联展示的字段
     * 
     * @var array $detailFields
     */
    public $detailFields = [];
    

    /**
     * 编辑使用的字段, 这里的编辑字段其实应该是基础
     * 
     * @var array $editFields
     */
    public $editFields = [];

    
    /**
     * 定义编辑相关模型的需要完成的数据添加操作
     * 1. 更新本model相关数据
     * 2. 新建相关model相关数据
     * 
     * @var array $newInBMFields
     * 1. insert the others task
     */
    public $editInBMFields = [];

    /**
     * 定义新建相关模型的需要完成的数据添加操作
     * 
     * @var array $newInBMFields
     * 1. insert camfile
     */
    public $newInBMFields = [];

    /**
     * 定义表名
     *
     * @var string
     */
    public $source = "";

    /**
     * Getsource
     * 
     * @return tablename
     */
    public function getSource()
    {
        return $this->source;
    }
}
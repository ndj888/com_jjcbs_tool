<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/21 0021
 * Time: 18:12
 */

namespace com_jjcbs\test\resource;
//{use template}

/**
 * @@Service()
 * Class TestAnnotationService
 * @package com_jjcbs\test\resource
 */
class TestAnnotationService
{
    /**
     * @@com_jjcbs\lib\annotation\OutPutFormat(type="json")
     * @var array
     */
    protected $type = [];
    /**
     * @@com_jjcbs\lib\annotation\Autowired(type="com_jjcbs\service\AnnotationServiceImpl)
     * @var null
     */
    protected $service = null;
    /**
     * @@com_jjcbs\lib\annotation\Autowired(type="com_jjcbs\service\AnnotationServiceImpl")
     * @var null
     */
    protected $testDao = null;
    public function __construct()
    {
//{construct template}
    }
    //{method template}
}
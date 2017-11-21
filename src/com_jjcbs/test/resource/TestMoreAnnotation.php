<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/21 0021
 * Time: 16:22
 */

//{use template}

namespace com_jjcbs\test\resource;

/**
 * Class TestMoreAnnotation
 * @package com_jjcbs\test\resource
 * @@com_jjcbs\lib\annotation\Service()
 */
class TestMoreAnnotation
{
    /**
     * @@com_jjcbs\lib\annotation\Autowired(type="com_jjcbs\service\AnnotationServiceImpl")
     * @var null
     */
    private $annoataionService = null;
    /**
     * @@com_jjcbs\lib\annotation\OutPutFormat(type="json")
     * @var array
     */
    private $type = [];
    public function __construct()
    {
//{construct template}
    }

    //{method template}
}
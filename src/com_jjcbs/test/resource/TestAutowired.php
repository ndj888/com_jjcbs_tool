<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/20 0020
 * Time: 17:30
 */

namespace com_jjcbs\test\resource;

//{use template}

use com_jjcbs\service\AnnotationServiceImpl;

class TestAutowired
{
    /**
     * @@com_jjcbs\lib\annotation\Autowired()
     * @var
     */
    private $annotationService = AnnotationServiceImpl::class;

    public function __construct()
    {
//{construct template}
    }
}
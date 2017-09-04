<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 12:41
 */

namespace com_jjcbs\lib;


use com_jjcbs\interfaces\AnnotationObjectInterface;
use com_jjcbs\service\AnnotationServiceImpl;

/**
 * base annotation class
 * if you use annotation , you should extend this class
 * Class AnnotationObject
 * @package com_jjcbs\lib
 */
abstract class AnnotationObject implements AnnotationObjectInterface
{
    public function __construct()
    {
        $this->exec();
    }

    public function exec()
    {
        // TODO: Implement exec() method.
        $annotationServiceImpl = ServiceFactory::getInstance(AnnotationServiceImpl::class);
        $annotationServiceImpl->setSrcClass($this);
        $annotationServiceImpl->exec();
    }


}
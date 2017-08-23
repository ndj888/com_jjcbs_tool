<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 11:13
 */

namespace com_jjcbs\interfaces;


/**
 * 注解接口定义一个注解规范
 * Interface AnnotationInterface
 * @package com_jjcbs\interfaces
 */
interface AnnotationInterface
{
    /**
     * parsed method list
     * the result example [method1 => ['name' => '' , 'param' => [] , 'doc' => '']
     * @param \ReflectionClass $class
     * @return mixed
     */
    public function parseMethodList(\ReflectionClass $class) : array ;

    /**
     * parsed class about info
     * the result example ['className' => '' , 'isAbstract' => false , 'doc' => '' , 'this' => src]
     * @param \ReflectionClass $class
     * @return array
     */
    public function parseClassInfo(\ReflectionClass $class) : array ;

    /**
     * parsed annotation and exec annotation function
     * maybe setter a class of variable or exec some things. you can implement interface extend it.
     * @param $annotationDoc
     * @return mixed
     */
    public function parseAnnotation(string $annotationDoc);

    /**
     * parsed vars before of  annotation , maybe setter these var value
     * the result example [var1 => ['name' => '' , 'param' => 'doc' => '' , 'type' => 'private', 'this' => '']]
     * @param \ReflectionClass $class
     * @return array
     */
    public function parseVarList(\ReflectionClass $class) : array ;

}
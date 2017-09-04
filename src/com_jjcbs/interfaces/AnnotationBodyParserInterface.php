<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/28 0028
 * Time: 13:37
 */

namespace com_jjcbs\interfaces;


/**
 * AnnotationBodyParserInterface
 * Class AnnotationBodyParserInterface
 * @package com_jjcbs\interfaces
 */
interface AnnotationBodyParserInterface
{
    /**
     * parsed method
     * @param \ReflectionMethod $method
     * @param array $input
     * @return string
     */
    public static function parseMethod(\ReflectionMethod $method , array $input): string;


    /**
     * parsed class
     * @param \ReflectionClass $class
     * @param array $input
     * @return string
     */
    public static function parseClass(\ReflectionClass $class , array $input): string;
}
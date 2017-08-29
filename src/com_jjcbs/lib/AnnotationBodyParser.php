<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/28 0028
 * Time: 13:36
 */

namespace com_jjcbs\lib;


use com_jjcbs\interfaces\AnnotationBodyParserInterface;

/**
 * Parser of annotation
 * return annotation context text
 * Class AnnotationBodyParser
 * @package com_jjcbs\lib
 */
class AnnotationBodyParser implements AnnotationBodyParserInterface
{
    public static function parseMethod(\ReflectionMethod $method, array $input): string
    {
        // TODO: Implement parseMethod() method.
        $start_line = $method->getStartLine() - 1;
        $end_line = $method->getEndLine();
        $length = $end_line - $start_line;
        return implode("", array_slice($input, $start_line, $length));
    }


    public static function parseClass(\ReflectionClass $class, array $input): string
    {
        // TODO: Implement parseClass() method.
        $start_line = $class->getStartLine() - 1;
        $end_line = $class->getEndLine();
        $length = $end_line - $start_line;
        return implode("", array_slice($input, $start_line, $length));
    }


}
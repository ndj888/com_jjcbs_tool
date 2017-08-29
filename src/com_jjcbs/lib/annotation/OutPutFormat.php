<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 15:46
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\lib\AnnotationMethodAbstract;

/**
 * format of type json serialize
 * Class OutPutFormat
 * @package com_jjcbs\lib\annotation
 */
class OutPutFormat extends AnnotationMethodAbstract
{
    static protected function parsedMethod($data = null)
    {
        // TODO: Implement parsedMethod() method.
    }

    static protected function parsedClass($data = null)
    {
        // TODO: Implement parsedClass() method.
        return 'disable';
    }

    static protected function parsedVar($data = null)
    {
        // TODO: Implement parsedVar() method.
        $getterStr = 'public function get' . ucfirst(self::$argv['varName']) . "(){\n"
            // body
            . $data
            .'}';
        self::$input = str_replace('//{{annotation placeholder}}' , $getterStr , self::$input);
    }

    static protected function do()
    {
        // TODO: Implement do() method.
        switch (self::$param['type']){
            case 'json':
                return sprintf('return json_decode($this->%s , true);' , self::$argv['varName']);
                break;
            default:break;

        }
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
        // no thing
        return ;
    }


}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/29 0029
 * Time: 17:23
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\fun\AnnotationFun;
use com_jjcbs\lib\AnnotationMethodAbstract;

class Rpc extends AnnotationMethodAbstract
{
    static protected function parsedMethod($data = null)
    {
        // TODO: Implement parsedMethod() method.
        self::$input =  AnnotationFun::replaceMethodStr(self::$body , AnnotationFun::createClosure(self::$body , self::$argv['methodName'], $data) , self::$input);
    }

    static protected function parsedClass($data = null)
    {
        // TODO: Implement parsedClass() method.
        return 'disable';
    }

    static protected function parsedVar($data = null)
    {
        // TODO: Implement parsedVar() method.
        return 'disable';
    }

    static protected function do()
    {
        // TODO: Implement do() method.
        return 'return new '.self::$param['type'].'(%s)';
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }

}
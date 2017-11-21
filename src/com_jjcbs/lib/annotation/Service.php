<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/29 0029
 * Time: 16:14
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\fun\AnnotationFun;
use com_jjcbs\lib\AnnotationMethodAbstract;

class Service extends AnnotationMethodAbstract
{
    static protected function parsedMethod($data = null)
    {
        // TODO: Implement parsedMethod() method.
        return 'disable';
    }

    static protected function parsedClass($data = null)
    {
        // TODO: Implement parsedClass() method.
        self::$input = AnnotationFun::replaceClassInfoStr(self::$argv['className'] , $data , self::$input);
    }

    static protected function parsedVar($data = null)
    {
        // TODO: Implement parsedVar() method.
        return 'disable';
    }

    static protected function do()
    {
        // TODO: Implement do() method.
        static::useNamespace('com_jjcbs\\lib\\Service');
        return 'class ' . self::$argv['className'] . ' extends Service';
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }


}
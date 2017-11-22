<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/22 0022
 * Time: 10:26
 */

namespace com_jjcbs\lib\annotation;
//{use template}

use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\lib\AnnotationMethodAbstract;

class Cache extends AnnotationMethodAbstract
{
    //{method template}
    static protected function parsedMethod($data = null)
    {
        // TODO: Implement parsedMethod() method.
        static::parseMethodExec($data);
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
        static::useNamespace('\\think\\facade\\Cache');
        $key = md5(self::$body);
        $tpl = <<<EOT
        \$cacheDriver = Cache::store('redis');
        if (\$arr = \$cacheDriver->get('%s')){
            return \$arr;
        }
        \$arr = \$fun();
        \$cacheDriver->set('%s' , \$arr , %d);
        return \$arr;
EOT;
        return sprintf($tpl , $key , $key , self::$param['time'] ?? 0);
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }


}
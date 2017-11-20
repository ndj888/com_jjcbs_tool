<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/20 0020
 * Time: 16:52
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\lib\AnnotationMethodAbstract;

class Autowired extends AnnotationMethodAbstract
{
    static protected function parsedMethod($data = null)
    {
        // TODO: Implement parsedMethod() method.
        return 'disable';
    }

    static protected function parsedClass($data = null)
    {
        // TODO: Implement parsedClass() method.
        return 'disable';
    }

    static protected function parsedVar($data = null)
    {
        // TODO: Implement parsedVar() method.
        static::$input = str_replace(static::CONSTRUCT_TEMPLATE, $data . static::CONSTRUCT_TEMPLATE, static::$input);
    }

    static protected function do()
    {
        // TODO: Implement do() method.
        static::useNamespace('com_jjcbs\\lib\\ServiceFactory');
        $tpl = <<<EOT
        \$this->%s = ServiceFactory(%s);
EOT;
        return sprintf($tpl, static::$argv['varName'] , '\'' .static::$param['type'] . '\'');
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }

}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/20 0020
 * Time: 16:52
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\fun\Main;
use com_jjcbs\lib\AnnotationMethodAbstract;
use com_jjcbs\lib\ServiceFactory;
use com_jjcbs\service\AnnotationServiceImpl;

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
        $namespace = ServiceFactory::getInstance(AnnotationServiceImpl::class)->getSrcClass();
        $reflectionClass = new \ReflectionClass($namespace);
        $obj = $reflectionClass->newInstanceWithoutConstructor();
        $property = $reflectionClass->getProperty(self::$argv['varName']);
        $property->setAccessible(true);
        $val = $property->getValue($obj);
        if (empty($val)) return '';
        static::useNamespace($val);
        //check is service
        $ref = new \ReflectionClass($val);
        $tpl = <<<PHP
        \$this->%s = new %s();
PHP;
        if ($parent = $ref->getParentClass()) {
            if ( $parent->getName() == 'service'){
                static::useNamespace('com_jjcbs\\lib\\ServiceFactory');
                $tpl = <<<EOT
        \$this->%s = ServiceFactory::getInstance(%s::class);
EOT;
            }
        }
        return sprintf($tpl, static::$argv['varName'], Main::getShortName($val));
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }

}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/29 0029
 * Time: 17:24
 */

namespace com_jjcbs\test\resource\annotation;
//{use template}

use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\lib\AnnotationMethodAbstract;

class RequestApi extends AnnotationMethodAbstract
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
        static::useNamespace('ext\\o2o\\ApiPath');
        static::useNamespace('ext\\o2o\\RequestApi');
        // 写接口配置
        $tpl = <<<PHP
        ;try{
            \$data = RequestApi::request(ApiPath::%s, \$request->param());
        }catch (\Exception \$e){
            return [];
        }
        return \$fun();
PHP;
        return sprintf($tpl, static::$param['name']);
    }

    static protected function exception(AnnotationException $exception)
    {
        // TODO: Implement exception() method.
    }


}
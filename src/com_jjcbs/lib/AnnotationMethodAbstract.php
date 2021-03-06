<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/29 0029
 * Time: 10:43
 */

namespace com_jjcbs\lib;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\fun\AnnotationFun;
use com_jjcbs\interfaces\AnnotationMethodInterface;
use com_jjcbs\service\AnnotationConfigServiceImpl;

/**
 * Class AnnotationMethodAbstract
 * @package com_jjcbs\lib
 */
abstract class AnnotationMethodAbstract implements AnnotationMethodInterface
{
    const DISABLE_SWITCH_NAME = 'disable';
    const USE_TEMPLATE = '//{use template}';
    const METHOD_TEMPLATE = '//{method template}';
    const CONSTRUCT_TEMPLATE = '//{construct template}';

    protected static $argv = [];
    protected static $param = [];
    protected static $input = '';
    protected static $body = ''; // body content
    protected static $config = []; //config配置文件

    /**
     * @param string $input
     * @return object
     */
    public static function setInput(string $input)
    {
        self::$input = $input;
    }



    public static function exec(array $argv, array $param, string $input = '')
    {
        // TODO: Implement exec() method.
        self::$argv = $argv;
        self::$param = $param;
        self::$body = $input;
        self::$config = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class)->getConfig();

        try{
            $funName = self::getMethodName();
            if ( self::DISABLE_SWITCH_NAME  === static::$funName(static::do()) ){
                throw new AnnotationException('the annotation not has ' . $funName . 'fun');
            }
            // return output
            return self::$input;
        }catch (AnnotationException $exception){
            static::exception($exception);
        }
    }

    /**
     * parsed method name
     * @return string
     */
    protected static function getMethodName(){
        return isset(self::$argv['methodName']) ? 'parsedMethod' : (isset(self::$argv['varName']) ? 'parsedVar' : 'parsedClass');
    }

    /**
     * parsing method replace static $input
     * @param $data
     * @return mixed
     */
    abstract static protected function parsedMethod($data = null);
    abstract static protected function parsedClass($data = null);
    abstract static protected function parsedVar($data = null);

    /**
     * the annotation must do things
     * you must implement the method
     * @return mixed
     */
    abstract static protected function do();

    /**
     * if exception
     * @param AnnotationException $exception
     * @return mixed
     */
    abstract static protected function exception(AnnotationException $exception);

    /**
     * parseMethodExec unitive
     * @param null $data
     */
    protected static function parseMethodExec($data = null){
        self::$input =  AnnotationFun::replaceMethodStr(self::$body , AnnotationFun::createClosure(self::$body , self::$argv['methodName'], $data) , self::$input);
    }

    protected static function useNamespace(string $namespace){
        if ( strpos(self::$input , "use {$namespace}") === false){
            self::$input = str_replace(self::USE_TEMPLATE , "use {$namespace};\n" . self::USE_TEMPLATE , self::$input);
        }
    }

    protected static function varMethodReplace(string $body){
        self::$input = str_replace(self::METHOD_TEMPLATE , $body , self::$input);
    }

    /**
     * 简易模版解析
     * @param array $data
     * @param string $tplName
     * @param string $str
     * @return string $str
     */
    protected static function tplParse($data = [], $tplName = '', $str = '')
    {
        $data = array_merge(static::$config['tplConf']['TPL_DATA'], $data);
        if (empty($str)) {
            $fileName = static::$config['tplConf']['TPL_DIR'] . $tplName;
            $str = file_get_contents($fileName);
        }
        foreach ($data as $k => $v) {
            $k = static::$config['tplConf']['TPL_SIGN_START'] . $k . static::$config['tplConf']['TPL_SIGN_END'];
            $str = str_replace($k, $v, $str);
        }
        return $str;
    }
}
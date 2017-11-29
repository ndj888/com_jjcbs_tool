<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/1 0001
 * Time: 13:49
 */

namespace com_jjcbs\fun;


/**
 * Annotation function
 * Class AnnotationFun
 * @package com_jjcbs\fun
 */
class AnnotationFun
{
    /**
     * create a closure by old method str
     * @param string $methodStr
     * @param string $methodName
     * @param string $data
     * @return string
     */
    public static function createClosure(string $methodStr , string $methodName , string $data = '') : string {
        if ( empty($data)){
            // no function body
            return '$fun = ' . preg_replace('/public|static|protected|private|public static|protected static|private static/'
                    , '' , str_replace($methodName , '' , $methodStr )
                . "\n\n//exec\n"
                . '$fun' . self::getMethodParamStr($methodStr));
        }else{
            return '$fun = ' . preg_replace('/public|static|protected|private|public static|protected static|private static/'
                    , '' , str_replace($methodName , '' , $methodStr )
                . "\n\n//exec\n"
                . sprintf($data , '$fun' . self::getMethodParamStr($methodStr) ));
        }
    }

    /**
     * create a getter function by var
     * @param string $varName
     * @param string $data
     * @return string
     */
    public static function createGetterByVar(string $varName , string $data = ''){
        return  'public function get' . ucfirst($varName) . "(){\n"
            // body
            . $data
            .'}';
    }

    /**
     * replace class info
     * @param string $className
     * @param string $data
     * @param string $input
     * @return mixed
     */
    public static function replaceClassInfoStr(string $className , string $data , string $input){
        return preg_replace(sprintf('/class\s*%s/' , $className) , $data , $input);
    }

    public static function createMethodClosure(string $methodStr , string $methodName){
        return preg_replace('/\{(.*)}/' , self::createClosure($methodStr , $methodName) , $methodStr);
    }


    public static function replaceMethodStr(string $methodStr , string $replace , string $input){
        $str = preg_replace('/\{[^}]*\}/' , '{' . $replace . '}' , $methodStr);
        return str_replace($methodStr , $str , $input);
    }
    /**
     * @param string $methodStr
     * @return string
     */
    protected static function getMethodParamStr(string $methodStr){
        if ( preg_match('/function\s*\w*\s*(\(.*\))/' , $methodStr , $match) !== false){
            return self::noParamType($match[1]);
        }
        return '';
    }

    /**
     * wipe out param type
     * @param string $str
     * @return string
     */
    public static function noParamType(string $str){
        if ( preg_match('/\$\w*\s*\,?/' , $str , $match) !== false){
            return $match[1] ?? '';
        }
        return '';
    }
}
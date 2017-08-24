<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 15:46
 */

namespace com_jjcbs\lib\annotation;


use com_jjcbs\interfaces\AnnotationMethodInterface;

/**
 * format of type json serialize
 * Class OutPutFormat
 * @package com_jjcbs\lib\annotation
 */
class OutPutFormat implements AnnotationMethodInterface
{
    public static function exec(array $argv, array $param)
    {
        // TODO: Implement exec() method.
        switch ($param['type']){
            case 'json':
                $str = '';
                $str .= $argv['varType'] . ' $' . $argv['varName'] . ';';
                return $str;
                break;
            case 'serialize':
                return serialize($param['methodValue']);
                break;
            default:break;
        }
        return '';
    }


}
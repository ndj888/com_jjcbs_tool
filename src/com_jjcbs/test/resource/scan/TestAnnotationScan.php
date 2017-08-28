<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 10:30
 */

namespace com_jjcbs\test\resource\scan;


/**
 * @@com\jjcbs\lib\annoation\Service
 * Class TestAnnotationScan
 * @package com_jjcbs\test\resource\scan
 */
class TestAnnotationScan
{
    /**
     * @@com_jjcbs\lib\annotation\OutPutFormat(type="json")
     * @return array
     */
    public function getArr(){
        return [
            'hellow',
            'json'
        ];
    }
}
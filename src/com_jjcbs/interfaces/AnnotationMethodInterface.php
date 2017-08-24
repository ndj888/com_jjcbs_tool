<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 14:18
 */

namespace com_jjcbs\interfaces;


/**
 * annotation methods must implement it.
 * Class AnnotationMethodInterface
 * @package com_jjcbs\interfaces
 */
interface AnnotationMethodInterface
{
    /**
     * exec some things or return some results
     * @param array $argv
     * @param array $param
     * @return mixed
     */
    public static function exec(array $argv  , array $param);
}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 11:37
 */

namespace com_jjcbs\enum\annotation;


use com_jjcbs\lib\Enum;

class ScopeNameEnum extends Enum
{
    protected $map = [
        'class' => 1, // class type
        'method' => 2, // method type
        'var' => 3 // var type
    ];
}
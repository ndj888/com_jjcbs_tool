<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 16:16
 */

namespace com_jjcbs\test\resource;


use com_jjcbs\lib\AnnotationObject;

class TestOutPutAnnotation extends AnnotationObject
{
    /**
     * @@com_jjcbs\lib\annotation\OutPutFormat(type="json")
     * @var string
     */
    private static $type = '123';
    public function getArr(){
        return [
            'text' => '123',
            'type' => 'blog'
        ];
    }
}
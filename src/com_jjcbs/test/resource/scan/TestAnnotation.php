<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/20 0020
 * Time: 15:04
 */

namespace com_jjcbs\test\resource\scan;


class TestAnnotation
{
    /**
     * @@OutPutFormat(type="json")
     * @var array
     */
    private $arr = [];

    /**
     * @@OutPutFormat(type="json")
     */
    private function do() : array {
        return [
            'type' => 'succeed',
            'count' => 2
        ];
    }
}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 16:08
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\test\resource\TestOutPutAnnotation;
use PHPUnit\Framework\TestCase;

class OutPutAnnoationTest extends TestCase
{
    public function testReturnType(){
        $outpuTest = new TestOutPutAnnotation();
        $this->assertJsonStringEqualsJsonString($outpuTest->getArr() , json_decode([
            'text' => '123',
            'type' => 'blog'
        ]));
    }
}
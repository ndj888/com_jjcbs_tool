<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/1 0001
 * Time: 14:07
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\fun\AnnotationFun;
use PHPUnit\Framework\TestCase;

class AnnotationFunTest extends TestCase
{
    public function testCreateClosure()
    {
        $str = '    public function testArr(){
       return [
           \'name\' => 1,
           \'age\' => 2
       ] ;
    }';
        $newStr = AnnotationFun::createClosure($str , 'testArr');
        $this->assertTrue(preg_match('/\$fun\s+\=\s+function/' , $newStr) !== false);
    }

    public function testnoParamType(){
        $str = '(string $name , string $body)';
        $newStr = AnnotationFun::noParamType($str);
        $this->assertTrue(strpos($newStr , 'string') === false);
    }
}
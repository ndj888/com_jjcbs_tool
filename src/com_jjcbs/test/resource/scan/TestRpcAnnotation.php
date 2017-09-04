<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/1 0001
 * Time: 11:54
 */

namespace com_jjcbs\test\resource\scan;


class TestRpcAnnotation
{
    /**
     * @@Rpc(type="com_jjcbs\test\resource\TestRpc")
     */
    public function testArr(){
       return [
           'name' => 1,
           'age' => 2
       ] ;
    }
}
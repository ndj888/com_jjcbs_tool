<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/18 0018
 * Time: 17:20
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\test\resource\UserRpc;
use PHPUnit\Framework\TestCase;

class RpcTest extends TestCase
{
    public function testCreateRpc(){
        $rpc = new UserRpc();
        $rpc->setUserName('李世民');
        $rpc->setUserAge(11);
        $this->assertNotNull($rpc);
        return $rpc;
    }

    /**
     * @depends testCreateRpc
     * @param UserRpc $rpc
     */
    public function testCheckRpcInfo(UserRpc $rpc){
        $this->assertEquals($rpc->getUserName() , '李世民');
        $this->assertEquals($rpc->toArray()['userName'] , '李世民');
    }
}
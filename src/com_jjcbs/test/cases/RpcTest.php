<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/18 0018
 * Time: 17:20
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\ListBean;
use com_jjcbs\test\resource\TestRpc;
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

    public function testToArray(){
        $testRpc = new TestRpc([
            'name' => 'cenhanyangsb',
            'age' => 15
        ]);
        $testRpc->setTestRpc(new TestRpc([
            'name' => 'longbob',
            'age' => 21
        ]));
        $testRpc->setUserList(new ListBean([
            new UserRpc(   [
                'userName' => 'wangkui',
                'userAge' => 28
            ]),
            new UserRpc(            [
                'userName' => 'lixuefeng',
                'userAge' => 29
            ])
        ]));
        $arr = $testRpc->toArray();
        $json = $testRpc->toJson();
        $this->assertNotEmpty($arr['testRpc']);
        $this->assertIsArray($arr['userList']);
        $this->assertNotEmpty($arr['userList']);
        $this->assertNotEmpty($json);
    }
}
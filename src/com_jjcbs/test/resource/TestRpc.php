<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/1 0001
 * Time: 11:56
 */

namespace com_jjcbs\test\resource;


use com_jjcbs\lib\ListBean;
use com_jjcbs\lib\SimpleRpc;

class TestRpc extends SimpleRpc
{
    protected $name = '';
    protected $age = 0;
    /**
     * @var TestRpc
     */
    protected $testRpc;
    /**
     * @var ListBean
     */
    protected $userList;

    /**
     * @return ListBean
     */
    public function getUserList(): ListBean
    {
        return $this->userList;
    }

    /**
     * @param ListBean $userList
     */
    public function setUserList(ListBean $userList)
    {
        $this->userList = $userList;
    }




    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return object
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return object
     */
    public function setAge(int $age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return TestRpc
     */
    public function getTestRpc(): TestRpc
    {
        return $this->testRpc;
    }

    /**
     * @param TestRpc $testRpc
     */
    public function setTestRpc(TestRpc $testRpc)
    {
        $this->testRpc = $testRpc;
    }

    


}
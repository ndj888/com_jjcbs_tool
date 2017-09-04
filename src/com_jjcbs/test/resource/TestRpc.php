<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/1 0001
 * Time: 11:56
 */

namespace com_jjcbs\test\resource;


use com_jjcbs\lib\SimpleRpc;

class TestRpc extends SimpleRpc
{
    protected $name = '';
    protected $age = 0;

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


}
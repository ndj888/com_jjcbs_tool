<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/18 0018
 * Time: 17:19
 */

namespace com_jjcbs\test\resource;


class UserRpc extends BaseRpc
{
    protected $userName = '';
    protected $userAge = 0;

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return object
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserAge(): int
    {
        return $this->userAge;
    }

    /**
     * @param int $userAge
     * @return object
     */
    public function setUserAge(int $userAge)
    {
        $this->userAge = $userAge;
        return $this;
    }


}
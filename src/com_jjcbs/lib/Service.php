<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/5/25 0025
 * Time: 9:46
 */

namespace com_jjcbs\lib;

/**
 * Class Service
 * @package ext\lib
 */
abstract class Service implements \com_jjcbs\interfaces\Service
{
    protected $tool = null;//工具类注入

    /**
     * @return null
     */
    public function getTool()
    {
        return $this->tool;
    }

    /**
     * @param null $tool
     * @return void
     */
    public function setTool($tool)
    {
        $this->tool = $tool;
    }


}
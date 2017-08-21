<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/5/24 0024
 * Time: 15:22
 */

namespace com_jjcbs\lib;
use com_jjcbs\tool\ServiceTool;

/**
 * Service Factory
 * Class ServiceFactory
 * @package ext\lib
 */
class ServiceFactory extends Factory
{
    public static function tool(): \com_jjcbs\interfaces\Tool
    {
        // TODO: Implement tool() method.
        return ServiceTool::getInstance();
    }


}
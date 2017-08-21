<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/5/24 0024
 * Time: 15:42
 */

namespace com_jjcbs\lib;


/**
 * 工具类构造
 * Class Tool
 * @package ext\lib
 */
trait Tool
{
    protected static $obj;

    /**
     * @return \com_jjcbs\interfaces\Tool Tool
     */
    public static function getInstance()
    {
        // TODO: Implement getInstance() method.
        if ( !(self::$obj instanceof self)){
            self::$obj = new self();
        }
        return self::$obj;
    }
}
<?php
/**
 * Created by JiangJiaCai
 * User: Administrator
 * Date: 2016/1/18 0018
 * Time: 11:01
 */

namespace com_jjcbs\lib;

/**
 * 配置信息基类
 * Class Conf
 * @package extend\lib
 */
class Conf
{
    static public $data = [];

    public static function setData($data)
    {
        self::$data = $data;
    }

    public static function getData()
    {
        return self::$data;
    }
}
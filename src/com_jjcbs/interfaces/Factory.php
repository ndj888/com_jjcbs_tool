<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/5/24 0024
 * Time: 15:24
 */

namespace com_jjcbs\interfaces;

/**
 * Interface Factory
 * @package ext\interfaces
 */
interface Factory
{
    /**
     * 获取实例
     * @param string $name
     * @param array $params
     * @throws \Exception
     * @return mixed
     */
    public static function getInstance(string $name , array $params = []);

    /**
     * 注册工厂实例
     * @param string $name
     * @param $obj
     * @return mixed
     */
    public static function register(string $name , $obj);

    /**
     * 移除工厂实例
     * @param string $name
     * @param $obj
     * @return mixed
     */
    public static function unRegister(string $name , $obj);
}
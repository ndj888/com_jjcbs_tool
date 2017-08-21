<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/5/24 0024
 * Time: 15:32
 */

namespace com_jjcbs\lib;


abstract class Factory implements \com_jjcbs\interfaces\Factory
{
    protected static $objMap = [];
//    protected static $nameSpace;

    /**
     * @return mixed
     */
    public static function getNameSpace()
    {
        return static::$nameSpace;
    }

    /**
     * @param mixed $nameSpace
     * @return object
     */
    public static function setNameSpace($nameSpace)
    {
        static::$nameSpace = $nameSpace;
    }


    public static function getInstance(string $name, array $params = [])
    {
        // TODO: Implement getInstance() method.
        if (!array_key_exists($name, self::$objMap)) {
            if (!class_exists($name)) throw new \Exception('factory not found obj');
            $class = new \ReflectionClass($name);
            self::$objMap[$name] = $class->newInstanceArgs($params);
            self::$objMap[$name]->setTool(static::tool());
        }
        return self::$objMap[$name];
    }

    public static function register(string $name, $obj)
    {
        // TODO: Implement register() method.
        self::$objMap[$name] = $obj;
    }

    public static function unRegister(string $name, $obj)
    {
        // TODO: Implement unRegister() method.
        //禁用 派生类需要可以自己实现
        return false;
    }

    /**
     * 返回一个该工厂的工具类
     * @return mixed
     */
    abstract public static function tool(): \com_jjcbs\interfaces\Tool;

}
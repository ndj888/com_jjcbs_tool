<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/3/21 0021
 * Time: 9:36
 */

namespace com_jjcbs\lib;


class Enum
{
    protected static $objMap = [];

    protected $map = [];
    protected $cMap = []; //拷贝


    public function __construct()
    {
        $this->cMap = $this->map;
        $this->encode();
    }

    public function getVal($key)
    {
        $k = base64_encode($key);
        return array_key_exists($k, $this->map) ? $this->map[$k] : $k;
    }

    public function getKey($val){
        return base64_decode(array_search($val , $this->map));
    }


    public function toStringFun($fun){
        return implode(',' , $fun($this->cMap));
    }

    public function getLen(){
        return count($this->map);
    }

    /**
     * 查找枚举key val是否存在
     * @param $val
     * @return bool
     */
    public function IsExist($val){
        return array_key_exists($val , $this->cMap) or array_search($val , $this->cMap) !== false;
    }

    private function encode(){
        $arr = [];
        foreach ($this->map as $k => $v){
            $arr[base64_encode($k)] = $v;
        }
        $this->map = $arr;
    }

    public static function create($className)
    {
        if ( !array_key_exists($className , self::$objMap)){
            self::$objMap[$className] = new $className();;
        }
        return self::$objMap[$className];
    }
}
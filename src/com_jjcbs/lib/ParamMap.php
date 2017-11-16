<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2016/12/15 0015
 * Time: 11:30
 */

namespace com_jjcbs\lib;

/**
 * 参数映射
 * Class ParamMap
 * @package ext\lib
 */
trait ParamMap
{
    protected $paramMap = [];

    /**
     * 根据Key获取参数映射名
     * @param $key
     * @return string
     */
    public function arrMapGetName($key){
        try{
            return $this->paramMap[$key];
        }catch (\Exception $e){
            return $key;
        }
    }

    /**
     * @param array $paramMap
     */
    public function setParamMap($paramMap)
    {
        $this->paramMap = $paramMap;
    }

    /**
     * 数组别名解析
     * @param $arr
     * @return array
     */
    public function arrMapParse(&$arr){
        $temp = [];
        foreach ($arr as $k => $v){
            $temp[$this->arrMapGetName($k)] = $v;
        }
        return $temp;
    }
}
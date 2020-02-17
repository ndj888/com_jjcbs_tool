<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/4/7 0007
 * Time: 13:10
 */

namespace com_jjcbs\lib;

/**
 * 远程调用
 * Class Rpc
 * @package ext\lib
 */
abstract class RPC
{
    public $rules = [];

    public function __construct(array $data = [])
    {
        !empty($data) && $this->setParam($data);
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), true);
    }

    /**
     * @param int $type 1 key->value 2 value 3 [key=>name value => v]
     * @return array
     */
    public function toArray($type = 1): array
    {
        $reflect = new \ReflectionClass($this);
        $arr = [];
        $props = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $temp = [];
            $name = $prop->getName();
            if (!is_null($this->$name)) {
                if ($this->$name instanceof RPC) {
                    $temp = $this->rpcDataParse($this->$name);
                } else if ($this->$name instanceof ListBean) {
                    foreach ($this->$name as $v) {
                        array_push($temp, $v->toArray());
                    }
                } else {
                    $temp = $this->$name;
                }
                switch ($type) {
                    case 1:
                        $arr[$name] = $temp;
                        break;
                    case 2:
                        $arr[] = $temp;
                        break;
                    case 3:
                        array_push($arr, [
                            'Key' => $name,
                            'Value' => $temp
                        ]);
                        break;
                    default:
                        break;
                }
            }
        }
        return $arr;
    }

    /**
     * 设置参数
     * @param $arr
     * @throws ValidationException $e
     */
    public function setParam($arr)
    {
        foreach ($arr as $k => $v) {
            if (!is_null($v) && property_exists($this, $k)) $this->$k = $v;
        }
        $this->check();
    }

    /**
     * 检查参数(兼容TP)
     * @return void
     * @throws \Exception
     */
    abstract protected function check();

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     * @return object
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }

    private function rpcDataParse(RPC $rpc)
    {
        return $rpc->toArray();
    }


}
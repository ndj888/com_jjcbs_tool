<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2016/12/20 0020
 * Time: 14:08
 */

namespace com_jjcbs\lib;


trait ApiJson
{
    protected $res = []; //回复内容
    public function echoJson(string $str){
        header('Content-Type:text/json;charset=utf-8;');
        echo $str;
        die;
    }
    public function setSucceed($data = []){
        $this->res['result'] = 1;
        $this->res['failureReason'] = '';
        $this->res['data'] = $data;
        return json_encode($this->res);
    }

    public function setError(string $msg = ''){
        $this->res['result'] = 0;
        $this->res['failureReason'] = $msg;
        throw new \Exception(json_encode($this->res));
    }

    /**
     * 设置JSON错误回复
     * @param string $msg
     * @return string
     */
    public function setJsonError(string $msg = ''){
        $this->res['result'] = 0;
        $this->res['failureReason'] = $msg;
        return json_encode($this->res);
    }

}
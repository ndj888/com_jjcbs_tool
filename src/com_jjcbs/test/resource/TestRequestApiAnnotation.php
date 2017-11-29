<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/29 0029
 * Time: 17:26
 */

namespace com_jjcbs\test\resource;
//{use template}

class TestRequestApiAnnotation
{
    //{method template}

    /**
     * @@com_jjcbs\test\resource\annotation\RequestApi(name="dsfsds")
     * @return array
     */
    public function getList(){
        return [];
    }
}
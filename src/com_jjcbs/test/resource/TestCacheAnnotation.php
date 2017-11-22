<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/22 0022
 * Time: 10:50
 */

namespace com_jjcbs\test\resource;
//{use template}

class TestCacheAnnotation
{
    //{method template}

    /**
     * @@com_jjcbs\lib\annotation\Cache(time=3600)
     * @return array
     */
    public function getData(){
        return [
            'fsdsd',
            'ddffsd'
        ];
    }
}
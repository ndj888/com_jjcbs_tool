<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/18 0018
 * Time: 17:17
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\ServiceFactory;
use com_jjcbs\test\resource\TestServiceImpl;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testCreateService(){
        $service = ServiceFactory::getInstance(TestServiceImpl::class);
        $this->assertNotNull($service);
    }
}
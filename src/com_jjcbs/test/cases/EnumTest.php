<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/18 0018
 * Time: 16:42
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\Enum;
use com_jjcbs\test\resource\TestEnum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testCreateEnum(){
        $enumObj = Enum::create(TestEnum::class);
        $this->assertNotNull($enumObj);
        return $enumObj;
    }

    /**
     * @depends testCreateEnum
     * @param \com_jjcbs\test\resource\TestEnum $enum
     */
    public function testEnumInfo(TestEnum $enum){
        $this->assertEquals($enum->getKey('v0.88') , '版本号');
        $this->assertEquals($enum->getVal('作者') , 'jjc');
    }
}
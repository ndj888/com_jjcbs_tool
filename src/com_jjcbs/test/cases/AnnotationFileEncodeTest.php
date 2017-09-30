<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/24 0024
 * Time: 15:32
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\AnnotationFileEncode;
use PHPUnit\Framework\TestCase;

define('COM_JJCBS_ROOT_PATH' , dirname(dirname(dirname(dirname(dirname(__FILE__))))));
class AnnotationFileEncodeTest extends TestCase
{


    public function testExec(){
        AnnotationFileEncode::setFilePath(COM_JJCBS_ROOT_PATH . '/src/com_jjcbs/test/resource/TestOutPutAnnotation.php');
        $arr = AnnotationFileEncode::exec();
        $this->assertNotEmpty($arr);
    }
}
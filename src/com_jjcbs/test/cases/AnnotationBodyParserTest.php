<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/28 0028
 * Time: 14:53
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\AnnotationBodyParser;
use com_jjcbs\service\AnnotationServiceImpl;
use PHPUnit\Framework\TestCase;

define('COM_JJCBS_ROOT_PATH', dirname(dirname(dirname(dirname(dirname(__FILE__))))));

class AnnotationBodyParserTest extends TestCase
{
    const FILE_PATH = COM_JJCBS_ROOT_PATH . '/src/com_jjcbs/service/AnnotationServiceImpl.php';

    public function testGetInput()
    {
        $input = [
            'class' => new \ReflectionClass(AnnotationServiceImpl::class),
            'input' => file_get_contents(self::FILE_PATH)
        ];
        $this->assertNotEmpty($input);
        return $input;
    }


    /**
     * @depends testGetInput
     */
    public function testMethod(array $input)
    {
        $str = AnnotationBodyParser::parseMethod($input['class']->getMethod('exec'), file(self::FILE_PATH));
        $this->assertNotEmpty($str);
    }

    /**
     * @depends testGetInput
     * @param string $input
     */
    public function testClassInfo(array $input)
    {
        $str = AnnotationBodyParser::parseClass($input['class'], file(self::FILE_PATH));
        $this->assertNotEmpty($str);
    }

}
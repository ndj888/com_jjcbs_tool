<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 16:46
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\lib\conf\AnnotationConfig;
use com_jjcbs\lib\drivers\AnnotationFileCacheDriverImpl;
use com_jjcbs\lib\ServiceFactory;
use com_jjcbs\service\AnnotationConfigServiceImpl;
use PHPUnit\Framework\TestCase;

define('COM_JJCBS_ROOT_PATH' , dirname(dirname(dirname(dirname(dirname(__FILE__))))));

class ScanAnnoationTest extends TestCase
{
    public function testSetConfig(){
        $configService = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class);
        $configService->setConfig(AnnotationConfig::$data);
        $this->assertNotEmpty(AnnotationConfig::$data);
        return $configService;
    }

    /**
     * @depends testSetConfig
     * @param AnnotationConfigServiceImpl $configServiceImpl
     */
    public function testScanAndCreate(AnnotationConfigServiceImpl $configServiceImpl){
        $scanf = new AnnotationFileCacheDriverImpl();
        // set composer.json config
        $scanf->scanNamespacesFiles();
        $this->assertFileExists( COM_JJCBS_ROOT_PATH . '/build/com_jjcbs/test/resource/scan/TestAnnotationScan.php');
    }
}
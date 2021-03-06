<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/24 0024
 * Time: 12:54
 */

namespace com_jjcbs\cases\test;


use com_jjcbs\conf\AnnotationAlias;
use com_jjcbs\lib\conf\AnnotationConfig;
use com_jjcbs\lib\drivers\AnnotationFileCacheDriverImpl;
use com_jjcbs\lib\ServiceFactory;
use com_jjcbs\service\AnnotationConfigServiceImpl;
use PHPUnit\Framework\TestCase;

define('COM_JJCBS_ROOT_PATH' , dirname(dirname(dirname(dirname(dirname(__FILE__))))));
class AnnotationCacheFileDriverTest extends TestCase
{

    private $annotationFileCacheDriver = null;
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->annotationFileCacheDriver = new AnnotationFileCacheDriverImpl();
    }

    public function testCreateConfig(){
        $config = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class);
        $config->setConfig(AnnotationAlias::$data);
        $this->assertNotNull($config);
        return $config;
    }
    /**
     * @depends testCreateConfig
     */
    public function testWrite(){
        $this->assertTrue($this->annotationFileCacheDriver->write(
            [
                'namespace' => 'com_jjcbs/conf',
                'fileName' => 'testConf',
                'className' => 'testConf',
                'output' => "<?php\n class conf{}"
            ]
        ));
    }

    public function testRead(){
        $this->assertNotEmpty($this->annotationFileCacheDriver->read('com_jjcbs/conf/testConf'));
    }

    public function testScan(){
        $this->annotationFileCacheDriver->scanNamespacesFiles();
        $this->assertFileExists(COM_JJCBS_ROOT_PATH. '/build/com_jjcbs/test/resource/scan/TestAnnotationScan.php');
    }
}
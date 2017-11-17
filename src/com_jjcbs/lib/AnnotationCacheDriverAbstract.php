<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 11:31
 */

namespace com_jjcbs\lib;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\fun\Main;
use com_jjcbs\interfaces\AnnotationCacheInterface;
use com_jjcbs\service\AnnotationConfigServiceImpl;

abstract class AnnotationCacheDriverAbstract implements AnnotationCacheInterface
{
    const LINE_HEAD = "<?php\n";
    const BUILD_MARK = '/**Build by com_jjcbs tool.**/';
    protected $annotationConfig = null;
    const FILE_SUF = '.php';

    public function __construct()
    {
        $this->annotationConfig = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class);
    }

    /**
     * scan file from namespaces
     * return all files list
     * example [file1,file2,file3]
     * @throws AnnotationException
     * @return void
     */
    public function scanNamespacesFiles() {
        $psrList = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class)->getConfig()['scanNamespace'];
        foreach ($psrList as $nameSpace){
            $path = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class)->getConfig()['appPath'] . '/' . str_replace('\\' , '/' , $nameSpace);
            if ( !is_dir($path)) throw new AnnotationException('dir not found' . $path);
            $tempFileList = $this->scanFile($path);
            // parse file and writing
            foreach ($tempFileList as $file){
                // compress , encode file and  build file
                if ( strpos($file , self::FILE_SUF ) === false) continue;
                $outPutArr = $this->encodeFile($file);
                !empty($outPutArr['output']) && $this->write($this->compress($outPutArr));
            }
        }
    }

    /**
     * load composer.json file
     * return composer.json psr-4 setting
     * @throws AnnotationException
     * @return array
     */
    protected function getComposePsrNamespaceList() : array {
        $jsonFilePath = $this->annotationConfig->getConfig()['composerFilePath'];
        if ( !file_exists($jsonFilePath)) throw new AnnotationException('Build Annotation error , composer.json file not found ' . $jsonFilePath);
        return json_decode(file_get_contents($jsonFilePath) , true);
    }

    /**
     * scan files from namespace
     * @param string $path
     * @return array
     */
    protected function scanFile(string $path) : array {
        return Main::scanDirectories($path);
    }

    protected function encodeFile(string $filePath) : array {
        AnnotationFileEncode::setFilePath($filePath);
        return AnnotationFileEncode::exec();
    }


    /**
     * create namespace of needed all dir
     * @param string $namespace
     */
    protected function namespaceCreateAllDir(string $namespace){
        if ( is_dir($namespace)) return;
        $dirList = explode('\\' , str_replace('/' , '\\' , $namespace));
        $path = $this->annotationConfig->getConfig()['appPath'] . '/build/';
        foreach ($dirList as $k => $dir){
            $path .=  '/' . $dir;
            // if not existed create the dir
            if ( !is_dir($path)) mkdir($path);
        }
    }

    /**
     * from namespace to file of path
     * @param string $namespace
     * @return string
     */
    protected function namespaceToBuildPath(string $namespace){
        return $this->annotationConfig->getConfig()['buildPath'] . str_replace('\\' , '/' , $namespace);
    }

    /**
     * create dir by file
     * @param $path
     */
    protected function createFileDir($path)
    {
        if (!file_exists($path)) {
            $this->createFileDir(dirname($path));
            mkdir($path, 0777);
        }
    }

    /**
     * file path to build path
     * @param $path
     * @return mixed|string
     */
    protected function fileToBuildPath($path){
        $configService = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class);
        $list = $configService->getConfig()['scanNamespace'];
        foreach ($list as $namespace => $filePath){
            if ( strpos($path , $filePath) !== false){
                return str_replace($configService->getConfig()['appPath'] .'/' .  $filePath , $configService->getConfig()['buildPath'] . str_replace('\\' , '/' , $namespace) , $path);
            };
        }
        return '';
    }
}
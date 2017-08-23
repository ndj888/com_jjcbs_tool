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
        $psrList = $this->getComposePsrNamespaceList()['autoload']['psr-4'];
        foreach ($psrList as $nameSpace){
            $path = COM_JJCBS_ROOT_PATH . '/' . str_replace('\\' , '/' , $nameSpace);
            if ( !is_dir($path)) throw new AnnotationException('dir not found' . $path);
            $tempFileList = $this->scanFile($path);
            // parse file and writing
            foreach ($tempFileList as $file){
                // compress , encode file and  build file
                $this->write($this->compress($this->encodeFile($file)));
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

    protected function encodeFile(string $filePath) : string {
        AnnotationFileEncode::setFilePath($filePath);
        return AnnotationFileEncode::exec();
    }


    /**
     * create namespace of needed all dir
     * @param string $namespace
     */
    protected function namespaceCreateAllDir(string $namespace){
        if ( is_dir($namespace)) return;
        $dirList = explode('\\' , $namespace);
        $str = '';
        foreach ($dirList as $k => $dir){
            $str .= $dir;
            $path = $this->annotationConfig->getConfig()['appPath'] . '/' . $dir;
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
        return $this->annotationConfig->getConfig()['appPath']  . '/build' . str_replace('\\' , '/' , $namespace);
    }
}
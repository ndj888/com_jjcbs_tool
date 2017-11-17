<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 16:01
 */

namespace com_jjcbs\lib\drivers;


use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\lib\AnnotationCacheDriverAbstract;

/**
 * annotation cache file implement
 * Class AnnotationFileCacheDriverImpl
 * @package com_jjcbs\lib\drivers
 */
class AnnotationFileCacheDriverImpl extends AnnotationCacheDriverAbstract
{

    public function read(string $className): string
    {
        // TODO: Implement read() method.
        return file_get_contents($this->namespaceToBuildPath($className) . self::FILE_SUF);
    }

    public function write(array $data): bool
    {
        // TODO: Implement write() method.
        try{
            if ( empty($data['namespace'])){
                // file build
                $fileBuidPath = $this->fileToBuildPath($data['fileName']);
                $this->createFileDir(preg_replace( '/\w+\.php/' , '' , $fileBuidPath));
                $fptr = fopen( $fileBuidPath , 'w');
            }else{
                // namespace build
                $this->namespaceCreateAllDir($data['namespace']);
                $fptr = fopen( $this->namespaceToBuildPath($data['namespace']) . '/' . $data['className'] .  self::FILE_SUF , 'w');
            }
            $header = strpos($data['output'] , self::BUILD_MARK) === false ? self::LINE_HEAD . self::BUILD_MARK : self::LINE_HEAD;
            fwrite($fptr , str_replace(self::LINE_HEAD , $header , $data['output']));
        }catch (\Exception $e){
            throw new AnnotationException('write class build file error : ' . $e->getMessage());
        }
        return true;
    }

    public function compress(array $data): array
    {
        // TODO: Implement compress() method.
        // nothing
        return $data;
    }


}
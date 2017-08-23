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
    }

    public function write(array $data): bool
    {
        // TODO: Implement write() method.
        $this->namespaceCreateAllDir($data['namespace']);
        try{
            $fptr = fopen($this->namespaceToPath($data['namespace']) . '/' . $data['fileName'] , 'w');
            fwrite($fptr , $data['output']);
        }catch (\Exception $e){
            throw new AnnotationException('write class build file error : ' . $e->getMessage());
        }
    }

    public function compress(array $data): array
    {
        // TODO: Implement compress() method.
        // nothing
        return $data;
    }


}
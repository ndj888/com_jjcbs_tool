<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 11:32
 */

namespace com_jjcbs\interfaces;


/**
 * Annotation cache interface
 * if you using other drivers , you must implement the interface
 * Interface AnnotationCacheInterface
 * @package com_jjcbs\interfaces
 */
interface AnnotationCacheInterface
{

    /**
     * reading the cache file from drivers
     * @param string $className
     * @return string
     */
    public function read(string $className) : string;

    /**
     * writing the cache file from drivers
     * @param array $data
     * example data ['output' => '' , 'namespace' => '']
     * @return bool
     */
    public function write(array $data) : bool;

    /**
     * compress cache data make of file smaller volume
     * @param array $data
     * @return array
     */
    public function compress(array $data) : array ;
}
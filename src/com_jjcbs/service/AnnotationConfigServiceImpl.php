<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 11:44
 */

namespace com_jjcbs\service;


use com_jjcbs\lib\Service;

/**
 * annotation config service only
 * Class AnnotationConfigServiceImpl
 * @package com_jjcbs\service
 */
class AnnotationConfigServiceImpl extends Service
{
    protected $config = [];

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return object
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }


    public function exec()
    {
        // TODO: Implement exec() method.
    }

}
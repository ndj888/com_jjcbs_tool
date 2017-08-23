<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 10:22
 */

namespace com_jjcbs\lib\conf;
use com_jjcbs\lib\Conf;


/**
 * the annotation config file
 * Class Config
 * @package com_jjcbs\lib\annotation
 */
class AnnotationConfig extends Conf
{
    public static $data = [
        // the alias map
        'alias' => [

        ],
        // These annotations will be scanning
        'scanNamespace' => [
            'com_jjcbs\\test\\resource\\scan'
        ],
        'composerFilePath' => COM_JJCBS_ROOT_PATH . '/composer.json',
        'appPath' => COM_JJCBS_ROOT_PATH
    ];
}
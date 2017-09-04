<?php

/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/9/4 0004
 * Time: 17:00
 */
namespace com_jjcbs\conf;
use com_jjcbs\lib\annotation\OutPutFormat;
use com_jjcbs\lib\annotation\Rpc;
use com_jjcbs\lib\annotation\Service;
use com_jjcbs\lib\Conf;

class AnnotationAlias extends Conf
{
    public static $data = [
        // the alias map
        'alias' => [
            'Service' => Service::class,
            'Rpc' => Rpc::class,
            'OutPutFormat' => OutPutFormat::class
        ],
        // These annotations will be scanning
        'scanNamespace' => [
            "com_jjcbs\\" => "src/com_jjcbs/"
        ],
        'appPath' => COM_JJCBS_ROOT_PATH,
        'buildPath' => COM_JJCBS_ROOT_PATH . '/build/'
    ];
}
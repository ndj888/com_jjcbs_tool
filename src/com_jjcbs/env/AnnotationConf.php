<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/17 0017
 * Time: 10:19
 */

return [
    // the alias map
    'alias' => [
        'Service' => \com_jjcbs\lib\annotation\Service::class,
        'Rpc' => \com_jjcbs\lib\annotation\Rpc::class,
        'OutPutFormat' => \com_jjcbs\lib\annotation\OutPutFormat::class
    ],
    // These annotations will be scanning
    'scanNamespace' => [
        "com_jjcbs\\service" => "src/com_jjcbs/service",
        "com_jjcbs\\lib" => "src/com_jjcbs/lib"
    ],
    'appPath' => COM_JJCBS_ROOT_PATH,
    'buildPath' => COM_JJCBS_ROOT_PATH . '/build/'
];
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 14:32
 */

namespace com_jjcbs\lib;
use com_jjcbs\fun\Main;
use \com_jjcbs\service\AnnotationServiceImpl;


/**
 * Parsed and encode annotation file
 * Class AnnotationFileEncode
 * @package com_jjcbs\lib
 */
class AnnotationFileEncode
{
    protected static $input = '';
    protected static $filePath = '';
    protected static $output = '';
    const LINE_HEAD = '<?php\n/**Build by com_jjcbs tool.**/\n\n';

    /**
     * @param string $filePath
     * @return object
     */
    public static function setFilePath(string $filePath)
    {
        self::$filePath = $filePath;
    }


    /**
     * return the result string
     * @return array
     */
    public static function exec() : array {
        self::$output = self::LINE_HEAD;
        // read file to class var
        self::$input = file_get_contents(self::$filePath);
        $annotationService = ServiceFactory::getInstance(AnnotationServiceImpl::class);
        // add get namespace from file.
        $namespace = Main::getNamespaceFromFile(self::$input) . '\\' . Main::getClassNameFromFile(self::$input);
        $annotationService->setSrcClass($namespace);
        $data = $annotationService->exec();
        !empty($data['classInfo']['doc']) and self::encodeClassInfo($data['classInfo']);
        !empty($data['varList']) && self::encodeVarList($data['varList']);
        !empty($data['methodList'])&&  self::encodeMethodList($data['methodList']);
        return [
            'output' => self::$output,
            'namespace' => $data['namespace'],
            'fileName' => $data['fileName']
        ];
    }

    /**
     * encode methodList
     * @param array $info
     * @return string
     */
    protected static function encodeMethodList(array &$info) {
        foreach ($info as $k => $method){
            $info[$k]['buildStr'] = forward_static_call_array([
                $method['annotation']['name'],
                'exec'
            ] , [
                'argv' => $method, // 环境相关参数，描述当前注解使用作用域名的上下文信息
                'param' => $method['annotation']['param']
            ]);
            self::$output .= $info[$k]['buildStr'];
        }
    }

    /**
     * encode var list
     * @param array $info
     * @return string
     */
    protected static function encodeVarList(array &$info) {
        foreach ( $info as $k => $var){
            $info[$k]['buildStr'] = forward_static_call_array([
                $var['annotation']['name'],
                'exec'
            ] , [
                'argv' => $var, // 环境相关参数，描述当前注解使用作用域名的上下文信息
                'param' => $var['annotation']['param']
            ]);
            self::$output .= $info[$k]['buildStr'];
        }
    }

    protected static function encodeClassInfo(array &$info) {
        $info['buildStr'] = forward_static_call_array([
            $info['annotation']['name'],
            'exec'
        ] , [
            'argv' => $info,
            'param' => $info['annotation']['param']
        ]);
        self::$output .= $info['buildStr'];
    }
}
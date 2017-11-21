<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 14:32
 */

namespace com_jjcbs\lib;

use com_jjcbs\fun\Main;
use com_jjcbs\service\AnnotationConfigServiceImpl;
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
    protected static $arrInput = [];

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
    public static function exec(): array
    {
        // read file to class var
        self::$output = self::$input = file_get_contents(self::$filePath);
        // add arr type
        self::$arrInput = file(self::$filePath);
        $annotationService = ServiceFactory::getInstance(AnnotationServiceImpl::class);
        // add get namespace from file.
        $className = Main::getClassNameFromFile(self::$input);
        // not has class name , because it's interface or trait
        if (empty($className)) return ['output' => self::$input, 'namespace' => '', 'fileName' => self::$filePath, 'className' => $className];
        // add class name there
        $className = Main::getClassNameFromFile(self::$input);;
        $namespace = Main::getNamespaceFromFile(self::$input) . '\\' . $className;
        $annotationService->setSrcClass($namespace);
        $data = $annotationService->exec();
        // not annotation parse return default
        $default = ['output' => self::$input, 'namespace' => $data['namespace'], 'fileName' => self::$filePath, 'className' => $className];
        if (empty($data['classInfo']['annotation']['name']) && empty($data['varList']) && empty($data['methodList'])) return $default;
        !empty($data['classInfo']['annotation']['name']) and self::encodeClassInfo($data['classInfo']);
        self::updateArrInput();
        !empty($data['varList']) && self::encodeVarList($data['varList']);
        self::updateArrInput();
        !empty($data['methodList']) && self::encodeMethodList($data['methodList']);
        self::updateArrInput();
        return [
            'output' => self::$output,
            'namespace' => $data['namespace'],
            'fileName' => $data['fileName'],
            'className' => $className
        ];
    }

    /**
     * encode methodList
     * @param array $info
     * @return string
     */
    protected static function encodeMethodList(array &$info)
    {
        foreach ($info as $k => $method) {
            // alias parse
            $method['annotation']['name'] = self::aliasMapParse($method['annotation']['name']);
            self::setInput($method);
            $info[$k]['buildStr'] = forward_static_call_array([
                $method['annotation']['name'],
                'exec'
            ], [
                'argv' => $method, // 环境相关参数，描述当前注解使用作用域名的上下文信息
                'param' => $method['annotation']['param'],
                'body' => AnnotationBodyParser::parseMethod($method['method'], self::$arrInput)
            ]);
            self::$output = $info[$k]['buildStr'];
        }
    }

    /**
     * encode var list
     * @param array $info
     * @return string
     */
    protected static function encodeVarList(array &$info)
    {
        foreach ($info as $k => $var) {
            // alias parse
            $info['annotation']['name'] = self::aliasMapParse($var['annotation']['name']);
            self::setInput($var);
            $info[$k]['buildStr'] = forward_static_call_array([
                $var['annotation']['name'],
                'exec'
            ], [
                'argv' => $var, // 环境相关参数，描述当前注解使用作用域名的上下文信息
                'param' => $var['annotation']['param']
            ]);
            self::$output = $info[$k]['buildStr'];
        }
    }

    protected static function encodeClassInfo(array &$info)
    {
        // alias parse
        $info['annotation']['name'] = self::aliasMapParse($info['annotation']['name']);
        self::setInput($info);
        $info['buildStr'] = forward_static_call_array([
            $info['annotation']['name'],
            'exec'
        ], [
            'argv' => $info,
            'param' => $info['annotation']['param'],
            'input' => AnnotationBodyParser::parseClass($info['class'], self::$arrInput)
        ]);
        self::$output = $info['buildStr'];
    }

    protected static function setInput(array &$info)
    {
        forward_static_call_array([
            $info['annotation']['name'],
            'setInput'
        ], [
            'input' => self::$output
        ]);
    }

    /**
     * alias map parse
     * @param string $name
     * @return string namespace
     */
    protected static function aliasMapParse(string $name): string
    {
        $config = ServiceFactory::getInstance(AnnotationConfigServiceImpl::class);
        $aliasArr = $config->getConfig()['alias'] ?? [];
        return array_key_exists($name, $aliasArr) ? $aliasArr[$name] : $name;
    }

    protected static function updateArrInput()
    {
        self::$arrInput = explode("\n", self::$output);
    }
}
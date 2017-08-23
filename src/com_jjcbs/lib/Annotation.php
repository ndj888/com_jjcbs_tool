<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/22 0022
 * Time: 11:16
 */

namespace com_jjcbs\lib;

use com_jjcbs\exceptions\AnnotationException;
use com_jjcbs\interfaces\AnnotationInterface;

/**
 * Annotation Abstract class
 * Class AnnotationAbstract
 * @package com_jjcbs\lib
 */
class Annotation implements AnnotationInterface
{
    protected $name = '';
    protected $reflectionInfo = [];
    const SUF_SIGN = '@@'; // the annotation must use @@ in content begin and must not has every char before content  left or right.


    public function getName(): string
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    protected function reflectionDoc($obj)
    {
        if (is_null($obj)) throw new AnnotationException('src object must not null');
        $reflectionInfo = new \ReflectionClass($obj);
        // get string annotation
        $this->reflectionInfo = [
            'classInfo' => $this->parseClassInfo($reflectionInfo),
            'methodsInfo' => $this->parseMethodList($reflectionInfo)
        ];

    }

    public function parseMethodList(\ReflectionClass $class): array
    {
        // TODO: Implement parseMethodList() method.
        $arr = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methodList = [];
        foreach ($arr as $info) {
            $methodInfo = $class->getMethod($info->name);
            array_push($methodList, [
                'name' => $info->name,
                'param' => $methodInfo->getParameters(),
                'doc' => $methodInfo->getDocComment(),
                'this' => $methodInfo
            ]);
        }
        return $methodList;
    }

    public function parseClassInfo(\ReflectionClass $class): array
    {
        // TODO: Implement parseClassInfo() method.
        return [
            'className' => $class->getName(),
            'isAbstract' => $class->isAbstract(),
            'doc' => $class->getDocComment(),
            'this' => $class
        ];
    }

    public function parseAnnotation(string $annotationDoc)
    {
        // TODO: Implement parseAnnotation() method.
        if ( preg_match('/'.self::SUF_SIGN.'(\S+)\((.*)\)/', $annotationDoc , $match) === false){
            throw new AnnotationException('parsed annotation error');
        }
        return [
            'name' => $match[1],
            // array type
            'param' => $this->parseParam($match[2])
        ];
    }

    protected function parseParam(string $docStr) : array
    {
        $data = [];
        $arr = explode( ',' , $docStr);

        foreach ($arr as $v) {
            $dv = explode('=', $v);
            $data[$dv[0]] = rtrim(ltrim($dv[1] , '"') , '"');
        }
        return $data;
    }

    public function parseVarList(\ReflectionClass $class): array
    {
        // TODO: Implement parseVarList() method.
        $arr = $class->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_STATIC);
        $varList = [];
        foreach ($arr as $info){
            array_push($varList , [
                'name' => $info->name,
                'doc' => $info->getDocComment(),
                'type' => $this->parseVarType($info),
                'this' => $info
            ]);

        }
        return $varList;

    }

    public function parseVarType(\ReflectionProperty $property){
        $typeArr = [];
        if ( $property->isPublic()) array_push($typeArr , 'public');
        if ( $property->isProtected()) array_push($typeArr , 'protected');
        if ( $property->isPrivate()) array_push($typeArr , 'private');
        if ( $property->isStatic()) array_push($typeArr , 'static');
        return implode(' ' , $typeArr);

    }



}
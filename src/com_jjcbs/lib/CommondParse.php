<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 13:37
 */

namespace com_jjcbs\lib;


/**
 * parsing commond
 * Class CommondParse
 * @package com_jjcbs\lib
 */
class CommondParse
{
    protected $argv = [];
    protected $commondName = '';
    protected $paramList = [];

    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }

    /**
     * @return string
     */
    public function getCommondName(): string
    {
        return $this->commondName;
    }

    /**
     * @param string $commondName
     * @return object
     */
    public function setCommondName(string $commondName)
    {
        $this->commondName = $commondName;
        return $this;
    }

    /**
     * @return array
     */
    public function getParamList(): array
    {
        return $this->paramList;
    }

    /**
     * @param array $paramList
     * @return object
     */
    public function setParamList(array $paramList)
    {
        $this->paramList = $paramList;
        return $this;
    }

    public function exec(){
        $this->paramList = array_slice($this->argv , 2 , count($this->argv));
        $this->commondName = $this->argv[1];
    }

}
<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 17:21
 */

namespace com_jjcbs\fun;


class Main
{
    /**
     * @param $rootDir
     * @param array $allData
     * @return array
     * @author php.net
     */
    public static function scanDirectories($rootDir, $allData = array())
    {
        // set filenames invisible if you want
        $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
        // run through content of root directory
        $dirContent = scandir($rootDir);
        foreach ($dirContent as $key => $content) {
            // filter all files not accessible
            $path = $rootDir . '/' . $content;
            if (!in_array($content, $invisibleFileNames)) {
                // if content is file & readable, add to array
                if (is_file($path) && is_readable($path)) {
                    // save file name with path
                    $allData[] = $path;
                    // if content is a directory and readable, add path and name
                } elseif (is_dir($path) && is_readable($path)) {
                    // recursive callback to open new directory
                    $allData = self::scanDirectories($path, $allData);
                }
            }
        }
        return $allData;
    }

    /**
     * get namespace from file
     * @param $input
     * @return string
     */
    public static function getNamespaceFromFile(&$input){
        if ( preg_match('/namespace\s+(\S+)\s?;/' , $input , $match) !== false){
            return $match[1] ?? '';
        }
        return '';
    }

    /**
     * get class name from file
     * @param $input
     * @return string
     */
    public static function getClassNameFromFile(&$input){
        if ( preg_match('/class\s+(\S+)\s*\S*\s*\S*\s*\S*\n*{/' , $input , $match) !== false){
            return $match[1] ?? '';
        }
        return '';
    }

}
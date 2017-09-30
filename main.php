<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/8/23 0023
 * Time: 13:28
 */

/**
 * tool run main file
 * Commond list
 * - build build these annotation to target dir ,load these files in runtime
 * - help show help document
 * - clean remove build dir and every build file
 */

define('COM_JJCBS_ROOT_PATH' , dirname(__FILE__));

// load autoload file
require 'vendor/autoload.php';
/**
 * run main function
 * @param array $argv
 * @param int $argc
 */
function main(array $argv , int $argc){
    $commond = new \com_jjcbs\lib\CommondParse($argv);
    $commondName = $commond->getCommondName();
    switch ($commondName){
        case 'build':
            build($commond);
            break;
        case 'help':
            showHelp();
            break;
        case 'clean':
            clean($commond);
            break;
        default:
            showHelp();
            break;
    }
}

/**
 * out put help document
 */
function showHelp(){

}

/**
 * build annotation dir
 * @param \com_jjcbs\lib\CommondParse $commondParse
 */
function build(\com_jjcbs\lib\CommondParse $commondParse){

}

/**
 * clean the build info
 * @param \com_jjcbs\lib\CommondParse $commondParse
 */
function clean(\com_jjcbs\lib\CommondParse $commondParse){

}
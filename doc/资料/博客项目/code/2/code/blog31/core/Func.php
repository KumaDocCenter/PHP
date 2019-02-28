<?php


/**
 * 功能：读取配置文件的配置值函数
 * @param   $str   string    读取配置文件的组合下标，
        例：如果要读取配置文件中的$config下的PDO元素的type值，则$str='PDO.type';
               如果要读取配置文件中的$config下的PDO元素的pwd值，则$str='PDO.pwd';
 */
function C($str){

    $arr = explode('.', $str);
    $c = $GLOBALS['config'];

    foreach( $arr as $v ){
        $c = $c[$v];
    }

    return $c;
}
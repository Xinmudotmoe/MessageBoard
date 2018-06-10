<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/23
 * Time: 18:25
 */
$black_chars=array("\"","`","'",";");
function spring($sstring){ //如果有异常字符进入运算 立即返回false
    global $black_chars;
    $tmp=str_split($sstring,1);
    foreach ($tmp as $aa )
        if(array_search($aa,$black_chars)!=null)
            return false;
    return true;
}
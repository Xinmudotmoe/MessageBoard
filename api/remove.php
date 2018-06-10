<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/6/10
 * Time: 15:26
 */
include "userUtil.php";
$key=array('pass','layer');
function error($code){//异常反馈
    echo $code;
    exit();
}
$__KEY=array_keys($_POST);
foreach ($key as $item){//检查键是否完整
    if(array_search($item,$__KEY)==null){
        error(-1);
    }
}
foreach ($key as $item)//检查值是否有被SQL注入的风险
    if (!spring($_POST[$item]))
        error(-2);
$id=userverification($_POST["pass"]);
if ($id<0)
    error($id);
$arrays=mysqli_query($Rsql,sprintf("SELECT id from U_data WHERE `layer`=%s;",
    $_POST["layer"]))->fetch_array();
if($arrays==null OR count($arrays)==0)
    error(-5);

if($id==0 OR $arrays[0]==$id){
    mysqli_query($Rsql,sprintf("DELETE FROM `U_data` WHERE `layer`=%s;",$_POST["layer"]));
    echo 1;
}
else
    error(-6);


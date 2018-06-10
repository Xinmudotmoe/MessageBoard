<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/23
 * Time: 18:43
 */
//输入参数 name pass mail sax
//记得就便在前面加一个FUCKPHP=TRUE 否则调用失败 //FIXME:

include "Conf.php";
include "util.php";
//$_POST=array('FUCKPHP'=>'TRUE','mail'=>'a','sax'=>'0','name'=>'a0s44d','pass'=>'a');
$key=array('name','pass','mail','sax');
function error($code){//异常反馈
    echo json_encode(array("code"=>$code));
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
$arrayname=mysqli_query($Rsql,sprintf("select id from user where name='%s';",$_POST["name"]));
if ($arrayname->fetch_array()!=null)
    error(-3);
mysqli_query($Rsql,sprintf("INSERT INTO user(name, pass, mail,sax) VALUES('%s', sha('%s'),'%s', %s);",$_POST["name"],$_POST["pass"],$_POST["mail"],$_POST["sax"]));
$arrayid=mysqli_query($Rsql,    sprintf("select id from user where name='%s';",$_POST["name"])    )->fetch_array();

$id=$arrayid;
echo json_encode(array('id'=>intval($id["id"]),'code'=>0));
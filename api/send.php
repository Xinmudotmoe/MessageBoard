<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/6/10
 * Time: 0:34
 */

include "userUtil.php";

$key=array('send','pass');
$__KEY=array_keys($_GET);
function error($code){//异常反馈
    // http_response_code(403);
    echo $code;
    exit();
}
foreach ($key as $item){//检查键是否完整
    if(array_search($item,$__KEY)==null){
        error(-1);
    }
}
foreach ($key as $item)//检查值是否有被SQL注入的风险 然而并无卵用
    if (!spring($_GET[$item]))
        error(-2);
$id=userverification($_GET["pass"]);
if ($id<0)
    error($id);

mysqli_query($Rsql,
    sprintf("INSERT INTO U_data(id,date,data) VALUES(%d,%d,'%s');",
        $id,intval(time()),$_GET["send"]));
echo 1;
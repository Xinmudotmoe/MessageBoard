<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/24
 * Time: 9:09
 */
//Post传入 sign pass参数 返回Key
include "Conf.php";
include "util.php";
//$_POST=array('fuckU'=>'ttt','sign'=>'a','pass'=>'a');
$key=array('sign','pass');
$__KEY=array_keys($_POST);
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
    if (!spring($_POST[$item]))
        error(-2);

$arrays=mysqli_query($Rsql,sprintf("SELECT id FROM user  where (name='%s' or id='%s' or mail ='%s')and pass=sha1('%s');",
    $_POST['sign'],$_POST['sign'],$_POST['sign'],$_POST['pass']  ))->fetch_array();
if($arrays==null OR count($arrays)==0)
    error(-3);
$time=intval(time());
$pass=sha1($arrays[0].$_POST['pass'].$time."0x1658");
mysqli_query($Rsql,sprintf("DELETE FROM user_status WHERE `id`=%s;",
    $arrays[0]));
mysqli_query($Rsql,sprintf("INSERT INTO user_status(id, pass, date) VALUES('%s', '%s','%s');",
                            $arrays[0],$pass,$time));

echo json_encode(array('id'=>$arrays[0],'pass'=>$pass));


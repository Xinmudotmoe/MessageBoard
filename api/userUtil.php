<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/24
 * Time: 9:49
 */
include "Conf.php";
include "util.php";
function userverification($pass){
    global $Rsql;
    $f=mysqli_query($Rsql,sprintf("SELECT id,date FROM user_status where `pass`='%s';",
        $pass  ))->fetch_array();
    if ($f==null)
        return -3;
    if ((intval(time())-1200)<$f[1])
        return $f[0];
    return -4;
}

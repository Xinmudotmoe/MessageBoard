<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/18
 * Time: 12:29
 */
include "Conf.php";
$q = mysqli_query($Rsql,"select id,name,sax,isdelete from user ORDER BY id".";");
echo json_encode(((array)$q->fetch_all()));
//TODO

<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/18
 * Time: 11:34
 */
include "Conf.php";
$q = mysqli_query($Rsql,"select id,date from user_status ORDER BY id".";");
echo json_encode(((array)$q->fetch_all()));
//TODO
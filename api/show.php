<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/31
 * Time: 1:18
 */
include "Conf.php";
$FUCK=mysqli_query($Rsql,"select * from U_data;")->fetch_all();
echo json_encode($FUCK);
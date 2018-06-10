<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/5/18
 * Time: 10:12
 */
define("SQL_host","localhost");
define("SQL_user","xinmu");
define("SQL_pass","xinmu");
define("SQL_db","test");
$Rsql = new mysqli(SQL_host,SQL_user,SQL_pass,SQL_db);
$Rts=array(
        array("user","
            `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(16) NOT NULL,
            `pass` VARCHAR(128) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `sax` TINYINT NOT NULL,
            `isdelete` TINYINT NOT NULL DEFAULT 0"),
        array("user_status","
            `id` BIGINT NOT NULL,
            `pass` VARCHAR(128) NOT NULL,
            `date` BIGINT NOT NULL,
            PRIMARY KEY (`id`)"),
        array("U_data","
        `layer` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id` BIGINT NOT NULL,
        `date` BIGINT NOT NULL,
        `data` VARCHAR(1024) NOT NULL")
);
function install(){
    global $Rsql,$Rts;
    foreach ($Rts as $rt){
        mysqli_query($Rsql,"CREATE TABLE "."`".$rt[0]."`"."(".$rt[1].");");
    }
}
function determine(){
    global $Rsql,$Rts;
    $query = mysqli_query($Rsql,"show tables;")->fetch_all();
    foreach ($Rts as $a) if (!array_key_exists($a[0],$query))
    {
        install();
        break;
    }
};
//determine();
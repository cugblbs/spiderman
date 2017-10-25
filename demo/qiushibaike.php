<?php
/**
 * Create By zhudong
 * Date: 2017/10/25
 * Time: 下午7:38
 * Desc:
 */
namespace spiderman\demo;

use spiderman\core\Spider;

require "../vendor/autoload.php";

$config = array(
    "name"=>"糗事百科",
    "db_config"=>array(
        "host"=>"10.95.118.56",
        "user"=>"root",
        "port"=>"3306",
        "password"=>"123456",
        "database"=>"spider"
    ),
);

$spider = new Spider($config);

$spider->start();
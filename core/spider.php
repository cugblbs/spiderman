<?php
/**
 * Create By zhudong
 * Date: 2017/10/25
 * Time: 下午7:33
 * Desc:
 */
namespace spiderman\core;

use spiderman\helper\DB;

class Spider {

    private $name = "";

    private $mode = "";

    public static $db_config = [];

    public function __construct($config) {
        $this->name = !empty($config['name']) ? $config['name'] : "spider";
        $this->mode = !empty($config['mode']) ? $config['mode'] : "csv";
        self::$db_config = $config['db_config'];
    }

    public function start() {
        DB::initDB(self::$db_config);
        $data = array(
            "city"=>"北京市",
            "name"=>'test',
        );
        $id = DB::insert("mafengwo_content", $data);
        var_dump($id);
    }

}
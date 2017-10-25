<?php
/**
 * Create By zhudong
 * Date: 2017/10/25
 * Time: 下午7:57
 * Desc:
 */
namespace spiderman\helper;

class DB {

    public static $db = null;

    private function __construct($config) {

        if(!function_exists("mysqli_connect")) {
            echo "Need Mysql Extension Support!".PHP_EOL;
            exit;
        }
        self::$db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database'],$config['port']);
        if(mysqli_connect_errno()) {
            echo "Connect Mysql Error，Errno:".mysqli_connect_errno();
            exit;
        }
    }

    public static function initDB($config) {

        if(self::$db == null) {
            $database = new DB($config);
        }
        mysqli_query(self::$db, " SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary, sql_mode='' ");
        return $database;
    }


    public static function query($sql) {
        if(self::$db) {
            mysqli_query(self::$db, $sql);
            $error_no = mysqli_errno(self::$db);
            if($error_no) {
                return false;
            }else {
                return true;
            }
        }
        return false;
    }

    public static function insert($table, array $data) {
        $items_sql = $values_sql = "";
        foreach ($data as $k => $v)
        {
            $v = stripslashes($v);
            $v = addslashes($v);
            $items_sql .= "`$k`,";
            $values_sql .= "\"$v\",";
        }

        $sql = "Insert Ignore Into `{$table}` (" . substr($items_sql, 0, -1) . ") Values (" . substr($values_sql, 0, -1) . ")";

        if (self::query($sql)) {
            return mysqli_insert_id(self::$db);
        } else {
            return false;
        }
    }



}
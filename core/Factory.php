<?php
    namespace core;
    /**
     * 工厂类
     */
    class Factory {
        /**
         * 数据库工厂方法
         */
        public static function getDatabase($id = 'master'){
            //读取数据库配置文件
            if ($id == 'master') {
                $db_conf = Init::getInstance()->config['DataBase']['master'];
            } else {
                $db_conf = Init::getInstance()->config['DataBase']['slave'];
            }
            $key = 'database_'.$id;
            //获取数据库对象
            $db = Register::get($key);
            if (!$db) {
                /**
                 * TODO在这里可以判断用PDO还是MySQLi
                 */
                $db = new PDODriver($db_conf['host'], $db_conf['user'], $db_conf['password'], $db_conf['dbname'], $db_conf['type']);
                Register::set($key, $db);
            }
            return $db;
        }

    }
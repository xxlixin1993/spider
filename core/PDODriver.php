<?php
namespace core;

class PDODriver {
        /**
         * @var 连接资源
         */
        public  $conn;

        /**
         * @var PDOStatement资源
         */
        public $sth;

        public function __construct($host, $user, $passwd, $dbname, $dbtype){
            $dsn = "{$dbtype}:dbname={$dbname};host={$host};charset=UTF8";
            try {
                $conn = new \PDO($dsn, $user, $passwd);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            $this->conn = $conn;
            // $conn->exec('set names utf8');
        }

        /**
         * 执行Sql
         * @param array $param 从1开始的一维数组,例array(1=>'value1',2=>'value2')
         */
        public function query($sql,$param) {

            $sth = $this->conn->prepare($sql);
            $this->sth = $sth;

            for ($i=1;$i<=count($param);$i++) {
                if (is_int($param[$i])) {
                    $sth->bindValue($i, $param[$i], \PDO::PARAM_INT);
                } else {
                    $sth->bindValue($i, $param[$i], \PDO::PARAM_STR);
                }
            }
            $res = $sth->execute();

            if ('select' == substr($sql,0,6)) {
                $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
                return $this->sth->fetchAll();
            } else {
                return $res;
            }
        }

        public function close(){
           $sth->closeCursor();
        }

}
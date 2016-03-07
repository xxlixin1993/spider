<?php
namespace model;

class PDODBHandle{

    /**
     *  数据库句柄
     */
    public $_db = null;

    /**
     *  表名
     */
    public $_table = '';

    /**
     *  sql语句
     */
    public $_sql = '';

    public function __construct($table) {
        $this->_db = \core\Factory::getDatabase();
        $this->_table = $table;
    }

    /**
     *  使用sql操作
     */
    public function query($sql, $param){
        $this->_sql = $sql;
        
        if ($result = $this->_db->query($sql, $param)){
            return $result;
        } else{
            return false;
        }
    }

    /**
     * 获得上次执行的SQL
     * @return string
     */
    public function getQuerySql()
    {
        return $this->m_sql;
    }


}
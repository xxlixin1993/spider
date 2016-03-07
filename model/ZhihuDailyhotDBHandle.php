<?php
namespace model;

class ZhihuDailyhotDBHandle extends PDODBHandle{

    public function __construct(){
        parent::__construct('zhihu_title_dailyhot');
    }



    public function selectContent(){
        $id = 4;
        $param = array('0'=>'4');
        $sql = "select * from zhihu_title_dailyhot where id = ?";
        if ($res = $this->query($sql, $param)){
            return $res;
        }else{
            echo 'error';exit;
        }
    }

}

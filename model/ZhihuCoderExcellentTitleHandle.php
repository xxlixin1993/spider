<?php
namespace model;

class ZhihuCoderExcellentTitleHandle extends PDODBHandle{

    public function __construct(){
        parent::__construct('zhihu_coder_excellentTitle');
    }

    public function insert($data){

        // $param = array('1'=>'4');
        // $sql = "select * from zhihu_title_dailyhot where id = ?";
        // $res = $this->query($sql, $param);
        // print_r($res);exit;

        $sql = "insert into zhihu_coder_excellentTitle (title,url,add_time) values ";
        $param = array();
        $i=1;
        foreach ($data as $key =>$val) {
            $sql .= "(?,?,?),";
            $param[$i] =  $val['title'];
            $i++;
            $param[$i] = $val['url'];
            $i++;
            $param[$i] = date('Y-m-d H:i:s',strtotime('now'));
            $i++;
        }
        $sql = substr($sql,0,strlen($sql)-1);

        if ($res = $this->query($sql, $param)) {
            return $res;
        }else{
            echo 'error';exit;
        }
    }

}
<?php
namespace core;

/**
 *  进程类
 */
class Process {

    /**
     * 子进程个数
     * @var int 
     */
    public $_process_num = null;

    /**
     * 拥有任务函数的对象
     * @var object
     */
    public $_func_obj = null;

    /**
     * 任务函数
     * @var callback
     */
    public $_mission_func = null;

    /**
     * 父进程id号
     * @var int
     */
    public $_parent_pid = null;

    /**
     * 初始化进程类
     * @param int $process_num 创建几个子进程
     * @param object $func_obj  拥有任务函数的对象
     */
    public function __construct($process_num,$func_obj){
        $this->_process_num = $process_num;
        $this->_parent_pid = getmypid(); 
        $this->_func_obj = $func_obj;
    }

    /**
     * 多进程处理任务
     * @param callback  $mission_func 子进程要进行的任务函数
     */
    public function dealMission($mission_func){
        $this->_mission_func = $mission_func;
    
        for($i = 0; $i < $this->_process_num; $i++){ 
                $pid[] = pcntl_fork(); 

                if($pid[$i] == 0){ 
                    //等于0时，是子进程 
                    $this->_func_obj->$mission_func($i+1); 

                    //结束当前子进程，以防止生成僵尸进程
                    if(function_exists("posix_kill")){
                        posix_kill(getmypid(), SIGTERM);
                    }else{
                        system('kill -9'. getmypid());
                    }
                    exit;
                } else if($pid > 0) { 
                    //大于0时，是父进程，并且pid是产生的子进程的PID 
                    //TODO 可以记录下子进程的pid，用pcntl_wait_pid()去等待程序并结束
                    pcntl_wait($status);
                } else {
                    throw new Exception('fork fail');
                }

        }
    }


}



//使用列子
// class Test{

//     function doMission($a){
//     if ($a == 1) {
//     echo 'first mission';
//     }else if($a == 2) {
//     echo 'second mission';
//     }
//     }

//     function foo(){
//         $p = new Process(10,$this);
//         $p->dealMission('doMission');
//     }
// }

// $t = new Test();
// $t->foo();

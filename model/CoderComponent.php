<?php
/**
 * 知乎程序员话题的组件层
 */
namespace model;
use core\Component;
use core\Curl;
use model\ZhihuCoderExcellentTitleWDHandle;

class CoderComponent extends Component{

    public function __construct(){
        parent::__construct();
    }

    /**
     * 获取知乎程序员title和url任务
     * @param $num　int 进程数
     */
    public function titleMission($num){

        if ($num == 1) {
            //进程1的任务 ,1-5page
            for ($i=1;$i<=5;$i++) {
                self::_getTitle($i);
            }
            // self::_getTitle(1);
        } else if ($num == 2) {
            // self::_getTitle(2);
            //进程2的任务 6-10page
            for ($i=6;$i<=10;$i++) {
                self::_getTitle($i);
            }
        }

    }

    /**
     * 获取coder话题对应页数的title和url
     * @param $pageNum int 第几页
     */
    public function _getTitle($pageNum){
            $curl = new Curl("https://www.zhihu.com/topic/19552330/top-answers?page={$pageNum}");
            $cookie = 'q_c1=820a23155b7c4337bbfe54acf8773b21|1451283378000|1451283378000; _za=a13ca887-021b-45da-88fe-c1b63982374b; _xsrf=33bdad31147bf00b064b50ec10f9976a; cap_id="NGVjMGYzMDIwNzlkNDVlYmE2NzZhNjQ1MzEyZGE1MDQ=|1451377826|61acc755db19be73bdcacd852fa1a97a1c8b6821"; z_c0="QUJEQ1p2REhLZ2dYQUFBQVlRSlZUYmZScVZhXzdNbl9MczFjd081Z3hQSjJHY0RoWG5GMmpRPT0=|1451377847|76fdc816777745015b2c1250b0a2fd190cefa84a"; __utma=51854390.1352335625.1451283386.1451351537.1451368990.3; __utmc=51854390; __utmz=51854390.1451351537.2.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); __utmv=51854390.100--|2=registration_date=20150601=1^3=entry_date=20150601=1';
            $curl->getMethod($cookie);
            $zhihuContent = $curl->exec();
            //变成一行
            $zhihuStr = preg_replace("/\n/", ' ',  $zhihuContent);
            preg_match_all('/<div class=\"feed-item feed-item-hook folding\" .*<div class=\"zm-invite-pager\">/', $zhihuStr, $out1);
            preg_match_all('/<h2>(.*?)<\/h2>/', $out1[0][0], $out2);

            $data = array();
            foreach ($out2[0] as $key=>$val) {
                    preg_match_all('/href=\"(.*?)\">/', $val, $tmp1,PREG_SET_ORDER);
                    preg_match_all('/>(.*?)</', $val, $tmp2);
                    $data[$key]['title'] = $tmp2[1][1];
                    $data[$key]['url'] =  'https://www.zhihu.com' . $tmp1[0][1];
            }

            $excellentHandle = new ZhihuCoderExcellentTitleHandle();
            $res = $excellentHandle->insert($data);
            var_dump($res);

    }


}
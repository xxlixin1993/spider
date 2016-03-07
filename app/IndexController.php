<?php
namespace app;
use core\Controller;
use core\Curl;
use comm\simple_html_dom;
use core\Process;
use model\CoderComponent;
class IndexController extends \core\Controller{

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function testAction(){
        /**
         * 知乎发现首页
         */
        $curl = new Curl('https://www.baidu.com');
        $cookie = 'a23155b7c4337bbfe54acf8773b21|1451283378000|1451283378000; _za=a13ca887-021b-45da-88fe-c1b63982374b; _xsrf=33bdad31147bf00b064b50ec10f9976a; cap_id="NGVjMGYzMDIwNzlkNDVlYmE2NzZhNjQ1MzEyZGE1MDQ=|1451377826|61acc755db19be73bdcacd852fa1a97a1c8b6821"; z_c0="QUJEQ1p2REhLZ2dYQUFBQVlRSlZUYmZScVZhXzdNbl9MczFjd081Z3hQSjJHY0RoWG5GMmpRPT0=|1451377847|76fdc816777745015b2c1250b0a2fd190cefa84a"; __utma=51854390.1352335625.1451283386.1451351537.1451368990.3; __utmc=51854390; __utmz=51854390.1451351537.2.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); __utmv=51854390.100--|2=registration_date=20150601=1^3=entry_date=20150601=1';
        $curl->getMethod($cookie);
        $zhihuContent = $curl->exec();
        print_r($curl->getResponseData());
 var_dump($zhihuContent);exit;
        $zhihuStr = preg_replace("/\n/", ' ',  $zhihuContent);
        preg_match_all('/<div class=\"explore-tab\" id=\"js-explore-tab\">.*<div class=\"zu-main-sidebar\">/', $zhihuStr, $out1);

        preg_match_all('/<h2>(.*?)<\/h2>/', $out1[0][0], $out2);
        //print_r($out2);exit;
        $html = new simple_html_dom();
        $data = array();
        foreach ($out2[0] as $key => $val) {
            $dom = $html->load($val);
            $data[$key]['title'] = $dom->find("a",0)->innertext;
            $data[$key]['url'] = 'https://www.zhihu.com' . $dom->find("a",0)->href ;
        }

        print_r($data);exit;
    }

    /**
     * 知乎程序员精华
     * https://www.zhihu.com/topic/19552330/top-answers?page=1
     */
    public function coderAction(){

        $coderComponent = new CoderComponent();
        $coderComponent->_getTitle(1);
        $p = new Process(2,$coderComponent);
        $p->dealMission('titleMission');

    }





}

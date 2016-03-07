<?php
namespace core;

class Curl {
    /**
     * curl句柄
     */
    public $ch;
    /**
     * 响应数据
     */
    private $output;
    /**
     * 响应头信息
     */
    private $responseData;
    /**
     * 请求url
     */
    public $url;

    /**
     * 域名
     */
    public $host;

    /**
     * @param string $url 必须是带协议的url,例http://www.baidu.com
     */
    public function __construct($url){
        //初始化
        $this->ch = curl_init();
        $this->url = $url;
        $this->host = parse_url($url)['host'];
    }
    /**
     *  GET方法
     *  @param string $cookie cookie字符串 例 'username=lx;passwd=123456'
     */
    public function getMethod($cookie=''){
        //设置选项，包括URL
        curl_setopt($this->ch, CURLOPT_HEADER, false);   // 返回header部分
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);          //重定向
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'LearnForPHP'); //User-agent设置
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10); //超时时长
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array( "Content-type: text/xml"));  //设置自定义头部
        if (!empty($cookie)){
            curl_setopt($this->ch, CURLOPT_COOKIE,$cookie);
        }
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }
    /**
     *  POST方法
     *  @param array $data key为post参数名 val为post参数值  例array('username'=>'lx')
     */
    public function postMethod($data){
        //设置抓取的url
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        //设置头文件的信息作为数据流输出
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($this->ch, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);          //重定向
    }

    /**
     * 执行设置好的请求
     * @return string 
     */
    public function exec(){
         //执行并获取HTML文档内容
        $this->output = curl_exec($this->ch);
        $this->responseData=curl_getinfo($this->ch);
        //释放curl句柄
        curl_close($this->ch);
        return $this->output;
    }
    /**
     * 获取上一次请求的响应头信息
     * @return array
     */
    public function getResponseData(){
            return $this->responseData;
    }

}
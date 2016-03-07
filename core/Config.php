<?php 
    namespace core;
    /**
     * 加载配置文件
     */
    class Config implements \ArrayAccess{
        //将所有的配置存放到自己的私有变量
        private $config = array();
        //保存要获取的config文件的路径
        protected $path;
        /**
         * 构造函数
         */
        public function __construct($path){
            //组织配置文件路径
            $this->path = $path . '/config/';
        }
        /**
         * 实现ArrayAccess的4个方法
         * @param   $key   配置文件名 例DatabaseConfig
         * @param   $val   
         */
        public function offsetGet($key){
            if (!isset($config[$key])) {
                //把配置文件的数组放在config属性中
                $this->config[$key] = require $this->path . $key . '.php';
            }
            //返回所调用的配置文件名
            return $this->config[$key];
        }
        //当要设置数组时会调用
        public function offsetSet($key, $value) {
            throw new \Exception("Cannot write config file.Plz modify the configuration by writing profiles.");
            
        }
        //当调用isset()时会调用
        public function offsetExists($key) {
            return isset($this->config[$key]);
        }
        //当要清除数组时会调用
        public function offsetUnset($key) {
            throw new \Exception("Cannot write config file.Plz modify the configuration by writing profiles.");
        }
    }

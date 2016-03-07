<?php 
    namespace core;
    use app;
    /**
     * 初始化
     */
    class Init{
        //用来保存init实例
        protected static $instance;
        public $base_dir;
        //配置文件对象
        public $config;
        //Debug模式
        public static $_debug = true;

        /**
         * 构造函数
         */
        protected function __construct($base_dir) {     
            $this->base_dir = $base_dir;
            $this->config = new Config($base_dir);
        }
        /**
         * 单例获得一个init实例
         * @param   string    $base_dir    
         * @return  object    init实例
         */
        public static function getInstance($base_dir = '') {
            if (empty(self::$instance)){
                self::$instance = new self($base_dir);
            }
                return self::$instance;
        }

        /**
         * 初始化程序
         */
        public static function init(){
            //检查系统环境是否是windows
            if (substr(PHP_OS, 0, 3) == "WIN")
                define("__IS_WIN__", 1);
            else
                define("__IS_WIN__", 0);
            //设置时区
            date_default_timezone_set('Asia/Shanghai');
            //设置php版本号
            if (!defined('PHP_VERSION_ID')) {
                $version = explode('.', PHP_VERSION);
                define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
            }
            //通过设置$_debug的值来判断是否开启调试模式，打开错误提示
            if (self::$_debug == true) {
                error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
                ini_set('display_errors', true);
            } else {
                error_reporting(0);
                ini_set('display_errors', false);
            }
            
            self::parseCommand();
        }

        /**
         * 根据传参判断进行什么操作,分发到对应的Controller的Action
         */
        public function parseCommand() {
            global $argv;
            $start_file = $argv[0]; 
            if(!isset($argv[1]) || !isset($argv[2]))
            {
                exit("Usage: php yourfile.php index test or your difined function}\n");
            }

            $c = '\\app\\'.trim(ucfirst($argv[1])) . 'Controller';
            $a = trim($argv[2]) . 'Action';
            $controller_file = BASEDIR.'/app/'. trim(ucfirst($argv[1])). 'Controller' .'.php';

            if (file_exists($controller_file)) {
                    $controller = new $c($c,$a);
                    $controller->$a();
            }
        }

    }
    /*EOF*/
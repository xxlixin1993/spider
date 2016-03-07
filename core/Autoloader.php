<?php
namespace core;
/**
 * 自动加载类
 */
class Autoloader{

    /**
     * 类的自动加载
     * @param  string $class 带命名空间的类名,例\core\Autoloader
     * @return void
     */
    public static function autoload($class){
        include BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
    }

}
// 设置类自动加载回调函数
spl_autoload_register('\\core\\Autoloader::autoload');
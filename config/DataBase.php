
<?php
    /**
     * 数据库配置文件 
     */ 
    $config = array(
        'master' => array(
            'type' => 'mysql',
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => '123456',
            'dbname' => 'spider',
        ),
        'slave' => array(
            'slave1' => array(
                'type' => 'mysql',
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => '123456',
                'dbname' => 'spider',
            ),
            'slave2' => array(
                'type' => 'mysql',
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => '123456',
                'dbname' => 'spider',
            ),
        ),
    );
    return $config;
?>
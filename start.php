<?php

//定义根目录 
define('BASEDIR',__DIR__);

require_once __DIR__ . '/core/Autoloader.php';

core\Init::getInstance(BASEDIR)->init();

<?php
namespace core;

class Controller{
    
    private static $_controller;
    private static $_action;

    public function __construct($controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
    }
}
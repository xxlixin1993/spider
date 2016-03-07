<?php
    namespace core;
    /**
     * 注册器类
     */
    class Register {
        protected static $objects;
        /**
         * 设置注册属性
         */
        public static function set($alias, $object) {
            self::$objects[$alias] = $object;
        }
        /**
         * 获取注册属性
         */
        public static function get($key) {
            if (!isset(self::$objects[$key])) {
                return false;
            }
            return self::$objects[$key];
        }
        /**
         * 清除注册属性
         */
        public function _unset($alias) {
            unset(self::$objects[$alias]);
        }
    }
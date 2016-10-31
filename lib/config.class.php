<?php

class Config {
    protected static $settings = array();

    public static function get($key){
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function set($key, $value) {
        self::$settings[$key] = $value;
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 07.12.2015
 * Time: 21:12
 */ 
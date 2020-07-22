<?php

/**
 * 门面设计模式
 * -  直接静态调用动态的对象
 * 
 * @demo:  Test::init()->func();
 * @demo2:   Test::fuc
 */

namespace mulo;

class Facade
{

    static $initInfo;
    ## 禁止直接new
    protected function __construct()
    {
        
    }

    static function getInstance()
    {
        ## 单例对象
        if (empty(static::$incitInfo)) {
            $class  =  static::getFacadeClass();
            static::$initInfo = new $class();
        }
        return static::$initInfo;
    }

    protected static function getFacadeClass()
    { }

    //门面调用
    public static function __callStatic($method, $params)
    {

        return call_user_func_array([static::getInstance(), $method], $params);
    }
}

<?php

/**
 * 单例设计模式
 * 
 * @demo:  Test::init()->func();
 * @demo2:   Test::fuc
 * 
 */

namespace mulo\facade;

class Auth extends \mulo\Facade
{
    protected static function getFacadeClass()
    {
        return 'mulo\Auth';
    }
}

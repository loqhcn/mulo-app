<?php

/**
 * 门面设计模式
 * -  直接静态调用动态的对象
 * 
 * @demo:  Test::init()->func();
 * @demo2:   Test::fuc
 */

namespace mulo;

class Auth
{
    /**
     * 生成一个认证令牌
     * @param username 用户名
     * @param password 密码
     */
    function buildAuthToken($username, $password)
    {
        return md5($username . $password . microtime());
    }

    /**
     * 对于公众号小程序等无密码账户
     * 
     */
    function buildAuthTokenByOpenid()
    {
        
    }
}

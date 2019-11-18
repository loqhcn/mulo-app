<?php

namespace mulo;

use mulo\facade\Random;

class UserLogic
{
    /**
     * 登录时,验证账号的类型
     * 
     * @return 账号类型 phone手机号 email邮箱 uname用户名
     */
    function accountType($account)
    {
        if (preg_match('/^1[0-9]{10}/$', $account)) {
            return 'phone';
        }
        if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/', $account)) {
            return 'email';
        }
        return 'uname';
    }

    /**
     * 生成密码盐
     * 
     * @return [$password加密后的密码,$salt密码盐]
     */
    function buildSalt()
    {
        return Random::str(6);
    }

    /**
     * 密码加密函数
     * 
     */
    function passwordAddKey($password, $salt = '')
    {
        return md5($password . $salt);
    }

    /**
     * 验证密码争取性
     * 
     * 
     * @return bool
     */
    function validatePassWord($password, $salt = '', $passwordStr)
    {
        $pstr = $this->passwordAddKey($password, $salt);
        if($pstr!=$passwordStr){
            return false;
        }
        return true;
    }
}

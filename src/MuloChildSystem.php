<?php

namespace mulo;

/**
 * 子系统操作
 * 
 * 开发文档: 
 * 
 */

use mulo\facade\Http;

class MuloChildSystem
{
    protected $config;

    // 配置示例
    // protected $config =  [
    //     //用户系统-服务端
    //     'user_system_action' => 'http://user.lqh.cn',
    //     //用户系统-应用名
    //     'user_system_appname' => 'apitool001',
    //     //用户系统-appid
    //     'user_system_appid' => 'apitool001',
    //     //用户系统-内部系统通讯令牌
    //     'user_system_token' => '123asdf',
    // ];

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 
     * 
     * @return apiUnityResult
     */
    function loginCheck($access_token)
    {
        ## user_system_action
        $param = [
            'appid' => $this->config['user_system_appid'],
            'access_token' => $access_token
        ];
        ## 加密
        $key = \mulo\Sign::init($this->config['user_system_token'])->MakeSign($param);
        $param['key'] = $key;
        
        ## 请求接口
        $ret = Http::httpRequest($this->config['user_system_action'] . '/api/oauth/loginUser', [
            'appid' => $this->config['user_system_appid'],
            'access_token' => $access_token,
            'key' => $key
        ]);
        if (!$ret) {
            return ['errno' => 501, '内部接入错误-请求验证登录'];
        }
        $ret = json_decode($ret, true);
        if (!$ret) {
            return ['errno' => 501, '内部接入错误-请求验证登录'];
        }
        ## 直接返回接口返回的结果
        return $ret;
    }


}

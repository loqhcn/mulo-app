<?php

namespace mulo;

/**
 * 通信签名  和微信支付一样
 * 
 */
class Sign
{
    protected $config;
    protected $token;
    private function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * 获取应用实例
     *
     * @param [type] $token
     * @return void
     */
    static function init($token)
    {
        
        return new self($token);
    }

    /**
     * 格式化参数格式化成url参数
     */
    public function ToUrlParams($values = [])
    {
        $buff = "";
        foreach ($values as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 生成签名 - 重写该方法
     * @param WxPayConfigInterface $config  配置对象
     * @param bool $needSignType  是否需要补signtype
     * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     */
    public function MakeSign($values, $needSignType = "sha256")
    {
        $key = $this->token;
        //签名步骤一：按字典序排序参数
        ksort($values);
        $string = $this->ToUrlParams($values);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $key;
        //签名步骤三：MD5加密或者HMAC-SHA256
        if ($needSignType == 'md5') {
            //如果签名小于等于32个,则使用md5验证
            $string = md5($string);
        } else {
            //是用sha256校验
            $string = hash_hmac("sha256", $string, $key);
        }
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
}

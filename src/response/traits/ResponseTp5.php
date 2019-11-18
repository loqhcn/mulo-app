<?php

namespace mulo\response\traits;

/**
 * thinkphp5类 统一api返回函数
 * 
 */
trait ResponseTp6
{
    function result($errno, $msg = "success", $data = false)
    {
        //多种写法兼容
        if (is_array($errno)) {
            $data = $errno;
            $errno = 0;
        } else if (is_string($errno)) {
            $msg = $errno;
            $errno = 1;
        }
        if (is_array($msg)) {
            $data = $msg;
            $msg = 'success';
        }
        //返回的数据
        $re = array(
            'errno' => $errno,
            'msg' => $msg,
            'data' => $data
        );
        //无数据的接口
        if ($data === false) {
            unset($re['data']);
        }
        return json($re,200);
    }
}

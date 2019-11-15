<?php

namespace mulo;

/**
 * 随机生成类
 * 
 */
class Random
{


    /**
     * 返回随机的一个字符串
     * 
     */
    function str($len)
    {
        return $this->buildRandom('alnum', 5);
    }

    function buildRandom($type, $len = 5)
    {

        switch ($type) {
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            default:
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }
        return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
    }

    /**
     * 返回一个唯一id
     * 
     */
    function uniqid($type = 'sha1')
    {
        switch ($type) {
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt':
            case 'sha1':
                return sha1(uniqid(mt_rand(), true));
        }
    }
}

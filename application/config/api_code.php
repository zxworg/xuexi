<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['api_code'] = [
    0     => '正确',
//    500   => '内部错误',
//    1001  => 'token无效',
    400001  => '参数不合法',
    403001  => '签名错误',
    403002  => '签名过期',
    403003  => '非法的客户密钥key(access_key)',
    500000  => '服务端处理请求出错',
];

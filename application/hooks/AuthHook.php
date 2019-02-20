<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author:      zjh<401967974@qq.com>
 * Date:        2019/2/20 0020
 * Time:        11:49
 * Describe:
 */

class AuthHook {
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function Auth(){

    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/smarty/Smarty.class.php';
require_once APPPATH.'third_party/smarty/Autoloader.php';

/**
 * Author:      zjh<401967974@qq.com>
 * Date:        2018/12/1 0001
 * Time:        14:57
 * Describe:
 */

class Smartyview extends Smarty {

    public $left_delimiter;
    public $right_delimiter;

    public function __construct()
    {
        parent::__construct();
        $this->setLeftDelimiter(config_item('smarty_left_delimiter'));
        $this->setRightDelimiter(config_item('smarty_right_delimiter'));
        $this->setUseSubDirs(config_item('smarty_use_sub_dirs'));
        $this->setCaching(config_item('smarty_caching'));
        $this->setCacheLifetime(config_item('smarty_cache_lifetime '));
        $this->setTemplateDir(config_item('smarty_template_dir'))
             ->setCompileDir(config_item('smarty_compile_dir'))
             ->setCacheDir(config_item('smarty_cache_dir'))
             ->setConfigDir(config_item('smarty_config_dir'));
        $CI = &get_instance();
        $CI->smarty = $this;
    }

}

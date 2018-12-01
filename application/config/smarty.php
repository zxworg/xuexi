<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['smarty_cache_lifetime'] = 60;
$config['smarty_caching'] = false;
$config['smarty_template_dir'] = APPPATH . 'views/smarty/templates';
$config['smarty_compile_dir'] = APPPATH . 'views/smarty/templates_c';
$config['smarty_cache_dir'] = APPPATH . 'views/smarty/cache';
$config['smarty_config_dir'] = APPPATH . 'views/smarty/config';
$config['smarty_use_sub_dirs'] = false;
$config['smarty_left_delimiter'] = '{';
$config['smarty_right_delimiter'] = '}';

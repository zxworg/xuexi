<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//正式环境数据库
$config['eloquent'] = array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'dbname',
    'username'  => 'username',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => '',
);

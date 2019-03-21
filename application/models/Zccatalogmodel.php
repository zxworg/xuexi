<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author:      zjh<401967974@qq.com>
 * Date:        2019/3/21 0021
 * Time:        18:48
 * Describe: 栏目信息
 */
class Zccatalogmodel extends Basemodel{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    protected $table = "zccatalog";
}

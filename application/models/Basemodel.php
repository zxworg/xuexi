<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Author:      zjh<401967974@qq.com>
 * Date:        2018/12/1 0001
 * Time:        10:40
 * Describe:
 */
class Basemodel extends Model {

    use SoftDeletes;

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Author:
 * Date:        2018/12/1 0001
 * Time:        10:40
 * Describe:
 */
class Basemodel extends Model {
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $hidden = ["ID"];
//    use SoftDeletes;

}

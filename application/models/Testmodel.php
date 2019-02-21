<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/2/21
 * Time: 23:28
 */
class  Testmodel extends Basemodel{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    protected $table = "test";
}
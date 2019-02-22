<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author:      zjh<401967974@qq.com>
 * Date:        2019/2/22 0022
 * Time:        9:52
 * Describe:
 */
class Api extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * SinglePush 单条推送
     */
    public function SinglePush($item_id){

    }

    /**
     * BatchPush 批量推送
     */
    public function BatchPush(){

    }

    /**
     * Delete
     */
    public function Delete(){

    }

    /**
     * Offline
     */
    public function Offline(){

    }

    /*
     * Online
     */
    public function Online(){

    }

    private function validateSinglePush(){
        return array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
        );
    }

}

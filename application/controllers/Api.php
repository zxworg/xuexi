<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Capsule\Manager as DB;
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
        $post = $this->input->post(null,true);
       if (!$this->validatePush($post)) {
           return;
       }
        try{
            DB::beginTransaction();


            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * BatchPush 批量推送
     */
    public function BatchPush(){
        $posts = $this->input->post(null,true);
        foreach ($posts as $post){
            if (!$this->validatePush($post)){
                return;
            }
        }
        try{
            DB::beginTransaction();


            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Delete 删除
     */
    public function Delete(){

    }

    /**
     * Offline 下线
     */
    public function Offline(){

    }

    /*
     * Online 上线
     */
    public function Online(){

    }

    /**
     * Get 获取资源
     */
    public function Get($item_id){

    }

    /*
     * splitUrl
     */
    private function splitUrl(){

    }

    /**
     * fullUrl
     */
    private function fullUrl(){
    }

    /**
     * validatePush 推送数据表单验证
     * @param $input
     * @return bool
     */
    private function validatePush($input){
        $field = [
            "item_type","item_id","url","title","sub_title","head_title",
            "summary","content","source","authors[]","publish_time","update_time",
            "tags","columns","extend_info","images","videos","audios","files",];
        if (!$this->validationText($this->validateSinglePushConfig(),$input)){
            $this->api_res(400001,$this->form_first_error($field));
            return false;
        }
        if (!empty($input["images"])){
            $field = ['url','desc','type','width','height','size',];
            foreach ($input["images"] as $image){
                if (!$this->validationText($this->validateImageConfig(),$image)){
                    $this->api_res(400001,$this->form_first_error($field));
                    return false;
                }
            }
        }
        if (!empty($input["videos"])){
            $field = ['url','original_url','title','desc', 'poster_url',
                'format','size','width','height','bitrate','sn'];
            foreach ($input["videos"] as $video){
                if (!$this->validationText($this->validateVideoConfig(),$video)){
                    $this->api_res(400001,$this->form_first_error($field));
                    return false;
                }
            }
        }
        if (!empty($input["audios"])){
            $field = ['url','original_url','title','desc','poster_url','lrc_url','format','size','duration','bitrate','sn'];
            foreach ($input["audios"] as $audio){
                if (!$this->validationText($this->validateAudioConfig(),$audio)){
                    $this->api_res(400001,$this->form_first_error($field));
                    return false;
                }
            }
        }
        if (!empty($input["files"])){
            $field = ['url','title','desc','poster_url','size','type'];
            foreach ($input["files"] as $file){
                if (!$this->validationText($this->validateFileConfig(),$file)){
                    $this->api_res(400001,$this->form_first_error($field));
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * validateSinglePushConfig 单条推送的表单验证配置
     * @return array
     */
    private function validateSinglePushConfig(){
        return array(
            array(
                'field' => 'item_type',
                'label' => 'item_typeitem_type',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'item_id',
                'label' => 'item_id',
                'rules' => 'trim|required|integer',
            ),
            array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'trim|valid_url',
            ),
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'sub_title',
                'label' => 'sub_title',
                'rules' => 'trim',
            ),
            array(
                'field' => 'head_title',
                'label' => 'head_title',
                'rules' => 'trim',
            ),
            array(
                'field' => 'summary',
                'label' => 'summary',
                'rules' => 'trim',
            ),
            array(
                'field' => 'content',
                'label' => 'content',
                'rules' => 'trim',
            ),
            array(
                'field' => 'source',
                'label' => 'source',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'authors[]',
                'label' => 'authors',
                'rules' => 'trim',
            ),
            array(
                'field' => 'publish_time',
                'label' => 'publish_time',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'update_time',
                'label' => 'update_time',
                'rules' => 'trim',
            ),
            array(
                'field' => 'tags[]',
                'label' => 'tags',
                'rules' => 'trim',
            ),
            array(
                'field' => 'columns[]',
                'label' => 'columns',
                'rules' => 'trim',
            ),
            array(
                'field' => 'extend_info',
                'label' => 'extend_info',
                'rules' => 'trim',
            ),
            array(
                'field' => 'images[]',
                'label' => 'images',
                'rules' => 'trim',
            ),
            array(
                'field' => 'videos[]',
                'label' => 'videos',
                'rules' => 'trim',
            ),
            array(
                'field' => 'audios[]',
                'label' => 'audios',
                'rules' => 'trim',
            ),
            array(
                'field' => 'files[]',
                'label' => 'files',
                'rules' => 'trim',
            ),
        );
    }

    /**
     * validateImageConfig 验证上传的图片
     * @return array
     */
    private function validateImageConfig(){
        return array(
            array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'desc',
                'label' => 'desc',
                'rules' => 'trim',
            ),
            array(
                'field' => 'type',
                'label' => 'type',
                'rules' => 'trim|in_list[jpg,jpe,jpeg,gif,png,webp,bmp,tif,tiff,fax,ico]',
            ),
            array(
                'field' => 'width',
                'label' => 'width',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'height',
                'label' => 'height',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'size',
                'label' => 'size',
                'rules' => 'trim|integer',
            ),
        );
    }

    /**
     * validateVideoConfig 验证video
     */
    private function validateVideoConfig(){
        return array(
            array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'original_url',
                'label' => 'original_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'trim',
            ),
            array(
                'field' => 'desc',
                'label' => 'desc',
                'rules' => 'trim',
            ),
            array(
                'field' => 'poster_url',
                'label' => 'poster_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'format',
                'label' => 'trim|required|in_list[flv,mp4,avi,wmv,mpg,mpg4,mov,mkv,f4v,m4v,rmvb,rm,3gp,m3u8,kux]',
                'rules' => 'trim',
            ),
            array(
                'field' => 'size',
                'label' => 'size',
                'rules' => 'trim|required|integer',
            ),
            array(
                'field' => 'width',
                'label' => 'width',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'height',
                'label' => 'height',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'bitrate',
                'label' => 'bitrate',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'sn',
                'label' => 'sn',
                'rules' => 'trim|integer',
            ),
        );
    }

    /**
     * validateAudioConfig 验证audio
     */
    private function validateAudioConfig(){
        return array(
            array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'original_url',
                'label' => 'original_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'trim',
            ),
            array(
                'field' => 'desc',
                'label' => 'desc',
                'rules' => 'trim',
            ),
            array(
                'field' => 'poster_url',
                'label' => 'poster_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'lrc_url',
                'label' => 'lrc_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'format',
                'label' => 'format',
                'rules' => 'trim|in_list[mp3,flac]|required',
            ),
            array(
                'field' => 'size',
                'label' => 'size',
                'rules' => 'trim|integer|required',
            ),
            array(
                'field' => 'duration',
                'label' => 'duration',
                'rules' => 'trim|integer|required',
            ),
            array(
                'field' => 'bitrate',
                'label' => 'bitrate',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'sn',
                'label' => 'sn',
                'rules' => 'trim|integer',
            ),
        );
    }

    /**
     * validateFileConfig 验证文件
     * @return array
     */
    private function validateFileConfig(){
        return array(
            array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'trim',
            ),
            array(
                'field' => 'desc',
                'label' => 'desc',
                'rules' => 'trim',
            ),
            array(
                'field' => 'poster_url',
                'label' => 'poster_url',
                'rules' => 'trim',
            ),
            array(
                'field' => 'size',
                'label' => 'size',
                'rules' => 'trim|integer',
            ),
            array(
                'field' => 'type',
                'label' => 'type',
                'rules' => 'trim|in_list[PDF]',
            ),
        );
    }
}

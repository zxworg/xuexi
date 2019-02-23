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

//    白名单
    private function writeList(){
        return [
            "gettoken",
            "welcomee"
        ];
    }

    public function Auth(){
        $this->CI->load->helper("url");
        $uri = uri_string();
        $writes = $this->writeList();
        if (in_array($uri,$writes)){
            return;
        }
        $get = $this->CI->input->get(null,true);
        $request_id = $this->CI->input->get_post("request_id",true);
        if (empty($get["token"])||empty($get["timestamp"]||empty($get["access_key"]))){
            headers_sent() or header('HTTP/1.1 401 Forbidden');
            headers_sent() or header("Content-Type:application/json;charset=UTF-8");
            echo json_encode(array(
                'code' => 400001,
                'error_message' => '参数不合法',
                "message" => [],
                "request_id" => $request_id));
            exit;
        }
        $secret = ACCESS_SECRET;
        $method = $_SERVER["REQUEST_METHOD"];
        $veData = [
            "secret" => $secret,
            "method" => $method,
            "uri" => $uri,
            "params" => $get
        ];
        $this->CI->load->library("m_jwt");
        $verifyCode = $this->CI->m_jwt->verify($veData,$get["token"]);
        if ($verifyCode > 0){
            headers_sent() or header('HTTP/1.1 401 Forbidden');
            headers_sent() or header("Content-Type:application/json;charset=UTF-8");
            $msg = $this->CI->config->item('api_code')[$verifyCode];
            echo json_encode(array(
                'code' => $verifyCode,
                'error_message' => $msg,
                "message" => [],
                "request_id" => $request_id));
            exit;
        }
    }
}
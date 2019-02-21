<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/2/21
 * Time: 21:05
 */
class M_jwt{

//    验证
    public function verify($veData,$token){
        $gToken = $this->generateSignature($veData["secret"],$veData["method"],$veData["uri"],$veData["params"]);
        $access_key  = $veData["params"]["access_key"];
        $timestamp = $veData["params"]["timestamp"];
        if ($gToken != $token){
            return false;
        }
        $current = microtime();
        if ($current>($timestamp+10*60*1000)){
            return false;
        }
        return true;
    }

//  构造加密源串
    private function generateSignature($secret,$method,$uri,$params){
        $a = $secret;
        $b = strtoupper($method);
        $c = urlencode($uri);
        $d = "";
        if (isset($params["token"])){
             unset($params["token"]);
        }
        if (is_array($params)&&!empty($params)){
            $d = implode("&",$params);
        }
        $signature = $a."&".$b."&".$c."&".$d;
        return md5($signature);
    }

//
}
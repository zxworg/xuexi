<?php
defined('BASEPATH') OR exit('No direct script access allowed');
headers_sent() or header("Content-Type:application/json;charset=UTF-8");
echo json_encode(array(
    'code' => 50000,
    'error_message' => '内部错误',
    "message" => [],
    "request_id" => ""));
exit;
?>

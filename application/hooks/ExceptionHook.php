<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ExceptionHook extends MY_Controller
{
    private $CI;

    public function __construct() {
        $this->CI = &get_instance(); //获取CI对象
    }
    public function SetExceptionHandler()
    {
        set_error_handler(array($this, '_error_handler'));
        set_exception_handler(array($this, 'HandleExceptions'));
        register_shutdown_function(array($this, '_shutdown_handler'));
    }
    /*
     * 获取内部错误
     * */
    public function HandleExceptions($exception)
    {
        $_error =& load_class('Exceptions', 'core');
        $_error->log_exception('error', 'Exception: '.$exception->getMessage(), $exception->getFile(), $exception->getLine());

        if(true){
            $statusCode = method_exists($exception, 'getStatusCode')?$exception->getStatusCode():500;
            set_status_header($statusCode);
            !class_exists('CI_Controller') OR $ci = get_instance();
            $ci->result['err'] = $statusCode;
            $ci->result['err_message'] = $exception->getMessage();

            $data = [
                'uri'      => $_SERVER['REQUEST_URI'],
                'req'  => json_encode($_POST),
                'header'   => $_SERVER['HTTP_TOKEN'],
                'resp' => '内部错误',
                'err'      => json_encode($exception->getMessage()).'',
                'file'     => $exception->getFile(),
                'line'     => $exception->getLine(),
                'module'   => 'admin-api',
                'env'      => ENVIRONMENT,
            ];

            $url    = 'http://api.boss.strongberry.cn/v4/tools/log';
            $params = json_encode($data);
            $this->httpCurl($url,'post','',$params,'application/json');
            show_error($exception->getMessage(), 500, "An Error Was Encountered");
            exit(1);
        }
    }

    /*获取语法错误*/
    public function _shutdown_handler()
    {
        $last_error = error_get_last();
        if (isset($last_error) &&
            ($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
        {
            _error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
        }
    }

    public function _error_handler($severity, $message, $filepath, $line)
    {
        $is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

        if ($is_error)
        {
            set_status_header(500);
        }

        if (($severity & error_reporting()) !== $severity)
        {
            return;
        }

        $_error =& load_class('Exceptions', 'core');
        $_error->log_exception($severity, $message, $filepath, $line);
        if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
        {
            $data = [
            'uri'      => $_SERVER['REQUEST_URI'],
            'req'  => json_encode($_POST),
            'header'   => $_SERVER['HTTP_TOKEN'],
            'resp' => '语法错误',
            'err'      => json_encode($message)."",
            'file'     => $filepath,
            'line'     => $line,
            'module'   => 'admin-api',
            'env'      => ENVIRONMENT,
        ];

            $url    = 'http://api.boss.strongberry.cn/v4/tools/log';
            $params = json_encode($data);
            $this->httpCurl($url,'post','',$params,'application/json');
            $_error->show_php_error($severity, $message, $filepath, $line);
        }
        if ($is_error)
        {
            exit(1);
        }
    }
}
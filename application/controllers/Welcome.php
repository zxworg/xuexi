<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($b)
	{
//	    $input = $this->input->post(null,true);
//	    $input = $this->input->raw_input_stream;
	    var_dump($this->request);exit;
	    echo $b;
	    log_message("debug","测试log");
//	    echo 1;exit;
//        $this->smarty->display('home/welcome_message.tpl');
//	    $this->api_res(0);
//	    $this->load->library("m_jwt");
//	    $s = $this->m_jwt->generateSignature("111","Get","/welcome",$_GET);
//	    var_dump($s);
//	    echo 1;
        $this->load->model("testmodel");
        $this->load->model("zcarticlebodymodel");
        $a = Zcarticlebodymodel::Find(1);
        $this->api_res(0,$a);
        return

        $field = ["authors"];
        if (!$this->validationText($this->validate())){
            $this->api_res(400001,$this->form_first_error($field));
            return;
        }
        $this->api_res(0);
	}

	private function validate(){
	    return array(
	        array(
	            "field"=>"authors[]",
                "label"=>"authors",
                "rules"=>"required|trim"
            )
        );
    }

}

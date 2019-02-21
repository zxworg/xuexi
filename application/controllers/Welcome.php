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
	public function index()
	{
//        $this->smarty->display('home/welcome_message.tpl');
//	    $this->api_res(0);
//	    $this->load->library("m_jwt");
//	    $s = $this->m_jwt->generateSignature("111","Get","/welcome",$_GET);
//	    var_dump($s);
//	    echo 1;
        $this->load->model("testmodel");
        $a = Testmodel::Find(1);
        $this->api_res(0,$a);
	}

}

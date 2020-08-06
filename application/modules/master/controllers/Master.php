<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
	}

	public function template_admin($data)
	{
        $this->load->view('template_admin/template', $data);
    }

}
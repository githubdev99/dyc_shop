<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bantuan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function tentang_kami()
	{
		$title = 'Tentang Kami';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_tentang_kami'
		];

		$this->master->template_home($data);
	}

	public function cara_belanja()
	{
		$title = 'Cara Belanja';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_cara_belanja'
		];

		$this->master->template_home($data);
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
    }

	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'landing/contact',
			'getDataWeb' => $this->settings_model->getSettings('1')->row()
		);

		$this->load->view('landing/template/sites',$data);
	}
}

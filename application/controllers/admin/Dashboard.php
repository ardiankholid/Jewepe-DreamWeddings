<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
			// Set flashdata dan redirect ke halaman login jika session kosong
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Anda Tidak Memiliki Akses, Silakan Login!</strong></div>');
			redirect('login');
		}
		$this->load->model('catalog_model');
		$this->load->model('ordered_model');
    }
	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'admin/dashboard',
			'TotalCatalog' => $this->catalog_model->get_all_catalog()->num_rows(),
			'TotalPesanan' => $this->ordered_model->get_count_ordered('all')->num_rows(),
			'PesananMenunggu' => $this->ordered_model->get_count_ordered('requested')->num_rows(),
			'PesananDiterima' => $this->ordered_model->get_count_ordered('approved')->num_rows(),
		);

		$this->load->view('admin/template/main',$data);
	}
}
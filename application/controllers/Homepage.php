<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('catalog_model');
		$this->load->model('ordered_model');
		$this->load->helper('text');

	}
	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'landing/homepage',
			'getAllCatalog' => $this->catalog_model->get_all_catalog_landing()->result()
		);
		$this->load->view('landing/template/sites', $data);
	}

    public function check_order_status()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        $data['orders'] = $this->ordered_model->cek_data_ordered_by_name_and_email($name, $email)->result();

        $this->load->view('landing/order_status', $data);
    }
	public function detail()
	{
		if ($this->input->get('id')) {

			$cek_data = $this->catalog_model->get_catalog_by_id($this->input->get('id'))->num_rows();

			if ($cek_data > 0) {
				$data = array(
					'title' => 'Jewepe Dream Weddings',
					'page' => 'landing/detail',
					'catalog' => $this->catalog_model->get_catalog_by_id($this->input->get('id'))->row()
				);

				$this->load->view('landing/template/sites', $data);

			} else {
				redirect('/');
			}
		} else {
			redirect('/');
		}
	}

	public function order()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$cek_data = $this->ordered_model->cek_data_ordered($post['id'], $post['email'], $post['wedding_date'])->num_rows();

			if ($cek_data == 0) {

				$datetime = date("Y-m-d H:i:s");
				$data = array(
					'catalogue_id' => $post['id'],
					'name' => $post['name'],
					'email' => $post['email'],
					'phone_number' => $post['phone_number'],
					'wedding_date' => $post['wedding_date'],
					'status' => 'requested',
					'created_at' => $datetime,
				);

				$insert = $this->ordered_model->insert($data);

				if ($insert) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succes </strong> Terima kasih. Permintaan pesanan anda telah kami terima. Mohon tunggu konfirmasi kami melalui email. <button type="button" class="btn-close" data-bs-dismiss="alert" aris-label="Close"></button></div>');
					redirect('Homepage/detail?id=' . $post['id']);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed </strong> Maaf, Permintaan pesanan gagal. <button type="button" class="btn-close" data-bs-dismiss="alert" aris-label="Close"></button></div>');
					redirect('Homepage/detail?id=' . $post['id']);
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Failed </strong> Maaf, Paket dan tanggal pernikahan sudah anda pesan sebelumnya. Mohon tunggu konfirmasi dari kami. <button type="button" class="btn-close" data-bs-dismiss="alert" aris-label="Close"></button></div>');
					redirect('Homepage/detail?id=' . $post['id']);
			}
		} else {
			redirect('Homepage');
		}
	}
}
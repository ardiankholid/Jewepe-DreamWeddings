<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('username'))) {
			// Set flashdata dan redirect ke halaman login jika session kosong
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Anda Tidak Memiliki Akses, Silakan Login!</strong></div>');
			redirect('login');
		}
		$this->load->model('catalog_model');
	}

	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'admin/catalog',
			'getAllCatalog' => $this->catalog_model->get_all_catalog()->result()
		);

		$this->load->view('admin/template/main', $data);
	}

	public function add()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'admin/add_catalog',
		);

		$this->load->view('admin/template/main', $data);
	}

	public function edit()
	{
		if ($this->input->get('id')) {

			$cek_data = $this->catalog_model->get_catalog_by_id($this->input->get('id'))->num_rows();

			if ($cek_data > 0) {
				$data = array(
					'title' => 'Jewepe Dream Weddings',
					'page' => 'admin/edit_catalog',
					'catalog' => $this->catalog_model->get_catalog_by_id($this->input->get('id'))->row()
				);

				$this->load->view('admin/template/main', $data);

			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Noo</strong> Data Tidak Tersedia! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			}
		} else {
			redirect('admin/Catalog');
		}
	}

	public function addData()
	{
		if ($this->input->post()) {

			$post = $this->input->post();

			//var_dump($post['status_publish']);
			//die;

			$datetime = date("Y-m-d H:i:s");
			$filename = date('Ymd') . '_' . rand();

			$data = array(
				'package_name' => $post['package_name'],
				'description' => $post['description'],
				'price' => $post['price'],
				'status_publish' => $post['status_publish'],
				'user_id' => $this->session->userdata['user_id'],
				'created_at' => $datetime,
			);

			if (!empty($_FILES['image']['name'])) {
				if (file_exists('./assets/files/catalog/' . $_FILES['image']['name']) && $_FILES['image']['name'])
					unlink('./assets/files/catalog' . $_FILES['image']['name']);

				$upload = $this->_do_upload($filename);
				$data['image'] = $upload;
			}

			$insert = $this->catalog_model->insert($data);

			if ($insert) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succes </strong> Data Berhasil Di Simpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Succes </strong> Data Gagal Di Simpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			}
		} else {
			redirect('admin/Catalog');
		}
	}

	public function updateData()
	{
		if ($this->input->post()) {

			$post = $this->input->post();
			$cek_data = $this->catalog_model->get_catalog_by_id($post['id'])->num_rows(); 

			if ($cek_data > 0) {

				$getCatalog = $this->catalog_model->get_catalog_by_id($post['id'])->row();
				$datetime = date("Y-m-d H:i:s");
				$filename = date('Ymd') . '_' . rand();

				$data = array(
					'package_name' => $post['package_name'],
					'description' => $post['description'],
					'price' => $post['price'],
					'status_publish' => $post['status_publish'],
					'user_id' => $this->session->userdata['user_id'],
					'updated_at' => $datetime,
				);

				if (!empty($_FILES['image']['name'])) {
					if (file_exists('./assets/files/catalog/' . $getCatalog->image) && $getCatalog->image)
						unlink('./assets/files/catalog/' . $getCatalog->image);

					$upload = $this->_do_upload($filename);
					$data['image'] = $upload;
				}

				$update = $this->catalog_model->update($post['id'], $data);

				if ($update) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succes </strong> Data Berhasil Di Ubah! <i class="remove ti-close" data-dismiss="alert"></i></div>');
					redirect('admin/Catalog');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Noo </strong> Data Gagal Di Ubah! <i class="remove ti-close" data-dismiss="alert"></i></div>');
					redirect('admin/Catalog');
				}
			}
		} else {
			redirect('admin/Catalog');
		}
	}

	public function delete()
	{
		if(!empty($this->input->get('id', true))) {

			$Catalog = $this->catalog_model->get_catalog_by_id($this->input->get('id' , true))->row();

			if (file_exists('./assets/files/catalog/' . $Catalog->image) && $Catalog->image)
				unlink('./assets/files/catalog/' . $Catalog->image);

			$delete = $this->catalog_model->delete_by_id($this->input->get('id' , true));

			if ($delete) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Succes </strong> Data Berhasil Di Hapus! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Noo </strong> Data Gagal Di Hapus! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			}
		} else {
			redirect('admin/catalog');
		}
	}

	private function _do_upload($filename)
	{
		$config['file_name'] = $filename;
		$config['upload_path'] = './assets/files/catalog';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
		$config['max_size'] = 5000;
		$config['create_thumb'] = FALSE;
		$config['quality'] = '90%';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			$data['inputerror'][] = 'logo';
			$data['error_string'][] = 'upload error: ' . $this->upload->display_errors('', '');
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}
}

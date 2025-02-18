<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
        if (empty($this->session->userdata('username'))) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Anda Tidak Memiliki Akses, Silakan Login!</strong></div>');
			redirect('login');
		}
		$this->load->model('ordered_model');
	}

	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'admin/order',
			'getAllOrdered' => $this->ordered_model->get_all_ordered()->result()
		);

		$this->load->view('admin/template/main',$data);
	}

	public function updateStatus()
{
    // Mendapatkan ID dan status dari query string
    $id = $this->input->get('id');
    $status = $this->input->get('status');

    // Cek apakah ID dan status valid
    if ($id && $status) {
        $cek_data = $this->ordered_model->get_ordered_by_id($id)->num_rows();

        if ($cek_data > 0) {

            $datetime = date("Y-m-d H:i:s");
            $data = array(
                'status' => $status, // Menetapkan status yang diterima dari URL
                'user_id' => $this->session->userdata('user_id'),
                'updated_at' => $datetime,
            );

            // Memperbarui status di database
            $update = $this->ordered_model->update($id, $data);

            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success </strong> Status Berhasil Di Ubah! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Order');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed </strong> Status Gagal Di Ubah! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Order');
            }
        }
    } else {
        redirect('admin/Order');
    }
}


public function update($id, $data)
{
    $this->db->where('order_id', $id);
    return $this->db->update('orders', $data);
}

	public function delete()
	{
		if(!empty($this->input->get('id', true))) {

			$delete = $this->ordered_model->delete_by_id($this->input->get('id' , true));

			if ($delete) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Succes </strong> Data Berhasil Di Hapus! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Order');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Failed </strong> Data Gagal Di Hapus! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Catalog');
			}
		} else {
			redirect('admin/Order');
		}		
	}
	public function check_order_status()
{
    $name = $this->input->post('name');
    $email = $this->input->post('email');

    if ($name && $email) {
        $data['order_status'] = $this->ordered_model->get_order_status($name, $email);
        
        if (empty($data['order_status'])) {
            $data['message'] = 'Tidak ada pesanan';
        }

        $data['title'] = 'Check Order Status';
        $data['page'] = 'check_order_status';
        $this->load->view('template/main', $data);
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please provide both name and email!</div>');
        redirect('Homepage');
    }
}

}
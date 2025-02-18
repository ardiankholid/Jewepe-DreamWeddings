<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
			// Set flashdata dan redirect ke halaman login jika session kosong
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Anda Tidak Memiliki Akses, Silakan Login!</strong></div>');
			redirect('login');
		}
        $this->load->model('settings_model');
    }
	public function index()
	{

		$data = array(
			'title' => 'Jewepe Dream Weddings',
			'page' => 'admin/settings',
            'settings' => $this->settings_model->getSettings('1')->row()
		);

		$this->load->view('admin/template/main',$data);
	}

    public function updateData()
    {
        $post =$this->input->post();
        
        //var_dump($post);
        //die;

        if($post){
            $cek_id = $this->settings_model->getSettings($post['id'])->num_rows();

            if($cek_id > 0){
                $getSettings = $this->settings_model->getSettings($post['id'])->row();
                $filename = date('Ymd') . '_' . rand();

                $datetime = date("Y-m-d H:i:s");
                $data = array(
                    'website_name' => $post['website_name'],
                    'phone_number' => $post['phone_number'],
                    'email' => $post['email'],
                    'address' => $post['address'],
                    'maps' => $post['maps'],
                    'instagram_url' => $post['instagram_url'],
                    'youtube_url' => $post['youtube_url'],
                    'header_bussines_hour' => $post['header_bussines_hour'],
                    'time_bussines_hour' => $post['time_bussines_hour'],
                    'updated_at' => $datetime,
                );

                if(!empty($_FILES['logo']['name'])){
                    if(file_exists('./assets/files/' . $getSettings->logo) && $getSettings->logo)
                        unlink('./assets/files/' . $getSettings->logo);

                    $upload = $this->_do_upload($filename);
                    $data['logo'] = $upload;
                }

                $update = $this->settings_model->update($post['id'], $data);

                if($update){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succes </strong> Data Berhasil Di Update! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Settings');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Upss </strong> Data Gagagl Di Update <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Settings');
                } 
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succes </strong> Maaf ID Tidak Ditemukan <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Settings');
            } 
        } else{
            redirect('admin/Settings');
        }
    }

    private function _do_upload($filename) {
        $config['file_name']      = $filename;
        $config['upload_path']    = './assets/files';
        $config['allowed_types']   = 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']       = 5000;
        $config['create_thumb']   = FALSE;
        $config['quality']        = '90%';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('logo'))
        {
            $data['inputerror'][] = 'logo';
            $data['error_string'][] = 'upload error: ' .$this->upload->display_errors('','');
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
}
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function index()
    {
        // $passDefault = password_hash('admin123', PASSWORD_DEFAULT);
        // var_dump($passDefault);
        // die;

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Jewepe Dream Weddings'
            );

            $this->load->view('admin/login', $data);
        } else {
            if ($this->input->post()) {
                $post = $this->input->post();

                // var_dump($post); // Pastikan data dari form ditangkap
                // die;

                $where1 = $post["email"];
                // $where2 = array('username' =>['email'], 'user_id' => 1);

                $user = $this->user_model->getUserByUsername1($where1)->row();

                // var_dump($user); // Pastikan data user ditangkap
                // die;

                if ($user) {
                    $isPasswordTrue = password_verify($post["password"], $user->password);

                    if ($isPasswordTrue) {
                        $array = array(
                            'user_id' => $user->user_id,
                            'username' => $user->username
                        );

                        $this->session->set_userdata($array);
                        redirect('admin/Dashboard');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Password Anda Tidak Sesuai</strong></div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Username Tidak Terdaftar</strong></div>');
                    redirect('login');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        $this->session->sess_destroy();
        redirect('login');
    }
}
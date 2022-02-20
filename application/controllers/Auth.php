<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_auth');
    }


    public function index()
    {
        if ($this->session->userdata('id_level') == '1') {
            redirect('admin');
        } elseif ($this->session->userdata('id_level') == '2') {
            redirect('petugas');
        } elseif ($this->session->userdata('id_level') == '3') {
            redirect('');
        }

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/template/header');
            $this->load->view('auth/index');
            $this->load->view('auth/template/footer');
        } else {
            // validasinya success
            $this->process();
        }
    }

    public function process()
    {
        $data = $this->M_auth->check_login($this->input->post());
        if (count($data) > 2) {
            //set ke session
            $this->session->set_userdata($data);
            if ($data['id_level'] == '1') {
                //masuk ke halaman admin
                redirect('admin');
            } elseif ($data['id_level'] == '2') {
                //masuk ke halaman petugas
                redirect('petugas');
            } elseif ($data['id_level'] == '3') {
                //masuk ke halaman masyarakat
                redirect('');
            } else {
                redirect('auth');
            }
        } else {
            return false;
        }
    }

    public function registration()
    {
        if ($this->session->userdata('id_level') == '1') {
            redirect('admin');
        } elseif ($this->session->userdata('id_level') == '2') {
            redirect('petugas');
        } elseif ($this->session->userdata('id_level') == '3') {
            redirect('');
        }

        $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'required|trim');
        $this->form_validation->set_rules('telp', 'Nomer Telp', 'required|trim|numeric|min_length[11]');
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[tb_masyarakat.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'WPU User Registration';
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('auth/template/footer');
        } else {
            $this->M_auth->regis();
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please activate your account</div>');
            redirect('auth');
        }
    }


    public function blocked()
    {
        $this->load->view('404');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('id_level');

        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}

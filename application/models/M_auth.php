<?php
class M_auth extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function check_login($data)
    {
        //inisialisasi
        $username = $data['username'];
        $password = $data['password'];
        //get data petugas
        $dat = $this->db->query("SELECT tb_petugas.id_petugas, tb_petugas.username , tb_level.id_level , tb_petugas.password FROM tb_petugas INNER JOIN tb_level ON tb_petugas.id_level = tb_level.id_level WHERE username = '$username'")->result_array()[0];

        if ($this->db->affected_rows() < 1) {
            // $dat = $this->db->query("SELECT tb_masyarakat.id_user, tb_masyarakat.username , tb_level.id_level , tb_masyarakat.password FROM tb_masyarakat INNER JOIN tb_level ON tb_masyarakat.id_level = tb_level.id_level WHERE username = '$username'")->result_array()[0];
            $dat = $this->db->query("SELECT id_user, username,password FROM tb_masyarakat WHERE username = '$username'")->result_array()[0];
            $dat['id_level'] = '3';
        }
        if ($dat) {
            if ($this->db->affected_rows() > 0) {
                if (password_verify($password, $dat['password'])) {
                    return $dat;
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth/');
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
                redirect('auth/');
            }
        } else {
            return false;
        }
    }
    public function regis()
    {
        $username = $this->input->post('username', true);
        $nama_lengkap = $this->input->post('nama_lengkap', true);
        $telp = $this->input->post('telp', true);
        $data = [
            'username' => htmlspecialchars($username),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'nama_lengkap' => htmlspecialchars($nama_lengkap),
            'telp' => htmlspecialchars($telp),
        ];

        $this->db->insert('tb_masyarakat', $data);
    }
}

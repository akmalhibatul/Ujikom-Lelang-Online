<?php
class Masyarakat extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_masyarakat');
    $this->proses();
  }
  private function proses()
  {
    if ($this->session->userdata('id_level') != '3') {
      redirect('masyarakat');
    }
  }
  public function index()
  {
    $data['test'] = $this->session->userdata('id_user');
    $data['barang'] = $this->M_masyarakat->getAllDataBarang();
    $this->load->view('masyarakat/template/header');
    $this->load->view('masyarakat/index', $data);
    $this->load->view('masyarakat/template/footer');
  }

  public function penawaran($id)
  {
    $data['test'] = $this->session->userdata('id_user');
    $data['barang'] = $this->M_masyarakat->getBarangById($id);
    $this->load->view('masyarakat/template/header');
    $this->load->view('masyarakat/penawaran', $data);
    $this->load->view('masyarakat/template/footer');
  }
  public function tawar()
  {
    $this->M_masyarakat->lelang();
    $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil Menawarkan Harga.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
    redirect('masyarakat/');
  }
}

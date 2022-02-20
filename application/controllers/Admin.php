<?php
class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_admin');
    $this->proses();
  }

  private function proses()
  {
    if ($this->session->userdata('id_level') != '1') {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['lelang'] = $this->M_admin->getAllLelangData();
    $data['jumlah_barang'] = $this->M_admin->getJumlahBarang();
    $this->load->view('admin/template/header');
    $this->load->view('admin/index', $data);
    $this->load->view('admin/template/footer');
  }

  //view barang
  public function barang()
  {
    $data['barang'] = $this->M_admin->getAllBarang();
    $this->load->view('admin/template/header');
    $this->load->view('admin/barang', $data);
    $this->load->view('admin/template/footer');
  }
  public function tambah()
  {
    $this->load->view('admin/template/header');
    $this->load->view('admin/tambah');
    $this->load->view('admin/template/footer');
  }
  public function edit($id)
  {
    $data['barang'] = $this->M_admin->getBarangById($id);
    $this->load->view('admin/template/header');
    $this->load->view('admin/edit', $data);
    $this->load->view('admin/template/footer');
  }

  public function cetak()
  {
    $data['cetak'] = $this->M_admin->dataCetak();
    $this->load->view('admin/template/header');
    $this->load->view('admin/cetak', $data);
    $this->load->view('admin/template/footer');
  }

  public function cetak_pdf($id)
  {
    $data['cetak'] = $this->M_admin->dataCetakById($id);
    $data['history'] = $this->M_admin->dataPemenang($id);
    $this->load->view('petugas/cetakPDF', $data);
  }

  //view user
  public function user()
  {
    $data['petugas'] = $this->M_admin->getAllPetugas();
    $this->load->view('admin/template/header');
    $this->load->view('admin/user', $data);
    $this->load->view('admin/template/footer');
  }
  public function tambah_user()
  {
    $data['level'] = $this->M_admin->getLevel();
    $this->load->view('admin/template/header');
    $this->load->view('admin/tambah_user', $data);
    $this->load->view('admin/template/footer');
  }

  // Fungsi Barang

  // Tambah Barang
  public function create()
  {
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
    $this->form_validation->set_rules('tgl', 'Tanggal Lelang', 'required');
    $this->form_validation->set_rules('harga_awal', 'Harga Awal', 'required');
    $this->form_validation->set_rules('deskripsi_barang', 'Deskripsi Barang', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin/template/header');
      $this->load->view('admin/tambah');
      $this->load->view('admin/template/footer');
    } else {
      $this->M_admin->insert();
      $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Barang<strong>Berhasil</strong>Ditambahkan!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
      redirect('admin/barang');
    }
  }

  // Update Barang
  public function update()
  {
    $this->M_admin->update();
    $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Barang <strong>Berhasil</strong> Diubah!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
    redirect('admin/barang');
  }

  // Hapus Barang
  public function delete($id)
  {
    $id = $this->M_admin->delete($id);
    $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Barang <strong>Berhasil</strong> Dihapus!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
    redirect('admin/barang');
  }

  // End Fungsi Barang

  public function add_user()
  {
    $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    $this->form_validation->set_rules('id_level', 'Level', 'required');

    if ($this->form_validation->run() == FALSE) {

      $data['level'] = $this->M_admin->getLevel();
      $this->load->view('admin/template/header');
      $this->load->view('admin/tambah_user', $data);
      $this->load->view('admin/template/footer');
    } else {
      $this->M_admin->insertUser();
      $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data User <strong>Berhasil</strong> DiTambah!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
      redirect('admin/user');
    }
  }

  public function delete_user($id)
  {
    $this->M_admin->deleteUser($id);
    $this->session->set_flashdata('msg', '<div class="row mt-4">
        <div class="col-md-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data User <strong>Berhasil</strong> Dihapus!!!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>');
    redirect('admin/user');
  }
}

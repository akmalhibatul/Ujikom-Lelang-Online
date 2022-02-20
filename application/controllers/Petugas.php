<?php
class Petugas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_admin');
    $this->proses();
  }

  private function proses()
  {
    if ($this->session->userdata('id_level') != '2') {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['lelang'] = $this->M_admin->getAllLelangData();
    $data['jumlah_barang'] = $this->M_admin->getJumlahBarang();
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/index', $data);
    $this->load->view('petugas/template/footer');
  }

  public function cetak()
  {
    $data['cetak'] = $this->M_admin->dataCetak();
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/cetak', $data);
    $this->load->view('petugas/template/footer');
  }

  public function cetak_pdf($id)
  {
    $mpdf = new \Mpdf\Mpdf();
    $arr = array(
      'cetak' => $this->M_admin->dataCetakById($id),
      'history' => $this->M_admin->dataPemenang($id)
    );
    $data = $this->load->view('petugas/cetakPDF', $arr, true);
    $mpdf->WriteHTML($data);
    $mpdf->Output("Report.pdf", \Mpdf\Output\Destination::INLINE);
  }

  //view barang
  public function barang()
  {
    $data['barang'] = $this->M_admin->getAllBarang();
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/barang', $data);
    $this->load->view('petugas/template/footer');
  }
  public function tambah()
  {
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/tambah');
    $this->load->view('petugas/template/footer');
  }
  public function edit($id)
  {
    $data['barang'] = $this->M_admin->getBarangById($id);
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/edit', $data);
    $this->load->view('petugas/template/footer');
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
      $this->load->view('petugas/template/header');
      $this->load->view('petugas/tambah');
      $this->load->view('petugas/template/footer');
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
      redirect('petugas/barang');
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
    redirect('petugas/barang');
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
    redirect('petugas/barang');
  }

  // End Fungsi Barang

  //fungsi detail

  public function detail($id)
  {
    $data['lelang'] = $this->M_admin->getLelangDataById($id);
    $data['history'] = $this->M_admin->getHistory($id);
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/detail', $data);
    $this->load->view('petugas/template/footer');
  }

  public function status()
  {
    $id = $this->input->post('id_lelang');
    $data = $this->input->post('status');
    $this->M_admin->status($id, $data);
    $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> Mengganti status!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
    redirect('petugas/');
  }

  public function akhir($id)
  {
    $data['lelang'] = $this->M_admin->getLelangDataById($id);
    $data['history'] = $this->M_admin->getHistory($id);
    $data['ht'] = $this->M_admin->ht($id);
    $this->load->view('petugas/template/header');
    $this->load->view('petugas/akhir', $data);
    $this->load->view('petugas/template/footer');
  }

  public function akhiri()
  {
    $this->M_admin->akhiri_lelang();
    $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> Mengakhir Lelang!!!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
    redirect('petugas/');
  }
}

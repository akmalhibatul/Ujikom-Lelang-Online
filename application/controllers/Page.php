<?php
class Page extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_page');
  }
  public function index()
  {
    $data['barang'] = $this->M_page->getAllData();
    $this->load->view('template/header');
    $this->load->view('index', $data);
    $this->load->view('template/footer');
  }

  public function penawaran($id)
  {
    // $data['test'] = $this->session->userdata('id_user');
    $data['barang'] = $this->M_page->getBarangById($id);
    $this->load->view('template/header');
    $this->load->view('penawaran', $data);
    $this->load->view('template/footer');
  }

  public function tawar()
  {
    // $data = array(
    //   'id_lelang' => $this->input->post('id_lelang'),
    //   'id_barang' => $this->input->post('id_barang'),
    //   'id_user' => $this->input->post('id_user'),
    //   'penawaran_harga' => $this->input->post('penawaran_harga'),
    // );

    // $id_lelang = $this->input->post('id_lelang');
    $id_barang = $this->input->post('id_barang');
    // $id_user = $this->input->post('id_user');
    $penawaran_harga = $this->input->post('penawaran_harga');

    $harga_tertinggi_db = $this->db->query("SELECT harga_awal FROM tb_barang WHERE id_barang = '$id_barang'")->result_array()[0]['harga_awal'];
    if ($harga_tertinggi_db < $penawaran_harga) {
      $this->M_page->tawar();
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
      redirect('');
    } else {
      $this->session->set_flashdata('msg', '<div class="row mt-4">
            <div class="col-md-12">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Harga Terlalu Rendah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>');
      redirect('');
    }
    // $this->db->insert('history_lelang');
    // $this->session->set_flashdata('msg', '<div class="row mt-4">
    //         <div class="col-md-12">
    //           <div class="alert alert-success alert-dismissible fade show" role="alert">
    //             Berhasil Menawarkan Harga.
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //               <span aria-hidden="true">&times;</span>
    //             </button>
    //           </div>
    //         </div>
    //       </div>');
    // redirect('');
  }
}
// <?php
// $harga_tertinggi_db = 5000;
// $harga_post = 6000;

// if($harga_tertinggi_db < $harga_post) {
//     echo "berhasil";
// } else {
//     echo "Harga terlau rendah";
// }
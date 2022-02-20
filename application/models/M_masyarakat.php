<?php
class M_masyarakat extends CI_Model
{
    public function getAllDataBarang()
    {
        $query = "SELECT * FROM `tb_lelang` JOIN `tb_barang` ON tb_barang.id_barang = tb_lelang.id_barang WHERE tb_lelang.status = 'dibuka' AND DATE(`tgl_lelang`) = CURDATE() ORDER BY tb_lelang.id_lelang DESC";
        return $this->db->query($query)->result_array();
    }

    public function getBarangById($id)
    {
        $query = "SELECT * FROM `tb_lelang` JOIN `tb_barang` ON tb_barang.id_barang = tb_lelang.id_barang WHERE tb_lelang.id_barang = $id";
        return $this->db->query($query)->row_array();
    }
    public function lelang()
    {
        $id_lelang = $this->input->post('id_lelang');
        $id_barang = $this->input->post('id_barang');
        $id_user = $this->input->post('id_user');
        $penawaran_harga = $this->input->post('penawaran_harga');

        //harga tertinggi
        $harga_tertinggi_db = $this->db->query("SELECT harga_awal FROM tb_barang WHERE id_barang = '$id_barang'")->result_array();

        if ($harga_tertinggi_db[0]['harga_awal'] < $penawaran_harga) {
            $this->db->query("INSERT INTO `history_lelang`(`id_history`, `id_lelang`, `id_barang`, `id_user`, `penawaran_harga`) VALUES (NULL,'$id_lelang','$id_barang','$id_user','$penawaran_harga')");
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
            redirect('masyarakat/');
        }
    }
    public function harga_awal($id_barang)
    {
        $this->db->select('harga_awal');
        $this->db->from('tb_barang');
        $this->db->where('id_barang', $id_barang);
    }
}

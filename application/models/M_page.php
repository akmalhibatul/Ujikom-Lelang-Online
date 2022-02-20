<?php
class M_page extends CI_Model
{
    public function getAllData()
    {
        $query = "SELECT * FROM `tb_lelang` JOIN `tb_barang` ON tb_barang.id_barang = tb_lelang.id_barang WHERE tb_lelang.status = 'dibuka' AND DATE(`tgl_lelang`) = CURDATE() ORDER BY tb_lelang.id_lelang DESC";
        return $this->db->query($query)->result_array();
    }
    public function getBarangById($id)
    {
        $query = "SELECT * FROM `tb_lelang` JOIN `tb_barang` ON tb_barang.id_barang = tb_lelang.id_barang WHERE tb_lelang.id_barang = $id";
        return $this->db->query($query)->row_array();
    }
    public function tawar()
    {
        $data = array(
            'id_lelang' => $this->input->post('id_lelang'),
            'id_barang' => $this->input->post('id_barang'),
            'id_user' => $this->input->post('id_user'),
            'penawaran_harga' => $this->input->post('penawaran_harga'),
        );
        $this->db->insert('history_lelang', $data);
    }
}

<?php
class M_admin extends CI_Model
{
    public function getAllBarang()
    {
        return $this->db->get('tb_barang')->result_array();
    }

    public function getJumlahBarang()
    {
        $data_barang = "SELECT * FROM tb_barang";
        return $this->db->query($data_barang)->num_rows();
    }

    // Funsi barang
    public function insert()
    {
        $nama_barang = $this->input->post('nama_barang');
        $harga_awal = $this->input->post('harga_awal');
        $tanggal_akhir = $this->input->post('tgl');
        $deskripsi_barang = $this->input->post('harga_awal');
        $tanggal = date('Y-m-d');
        //insert ke tabel barang
        $this->db->query("INSERT INTO tb_barang VALUES (NULL, '$nama_barang','$tanggal','$harga_awal', '$deskripsi_barang')");
        //get id_barang
        $id_barang = $this->db->query("SELECT id_barang FROM tb_barang WHERE nama_barang = '$nama_barang' AND tgl = '$tanggal'")->result_array()[0]['id_barang'];
        //get id_petugas di session
        $id_petugas = $this->session->userdata('id_petugas');
        //untuk status ada dua pilihan value yaitu 'buka' dan 'tutup'

        $status = 'ditutup';
        //insert ke tabel lelang
        $this->db->query("INSERT INTO `tb_lelang`(`id_lelang`, `id_barang`, `tgl_lelang`, `harga_akhir`, `id_user`, `id_petugas`, `status`) VALUES (NULL,'$id_barang','$tanggal_akhir','','','$id_petugas','$status')");
    }

    public function getBarangById($id)
    {
        return $this->db->get_where('tb_barang', ['id_barang' => $id])->row_array();
    }

    public function update()
    {
        $id = $this->input->post('id_barang');
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'tgl' => $this->input->post('tgl'),
            'harga_awal' => $this->input->post('harga_awal'),
            'deskripsi_barang' => $this->input->post('deskripsi_barang'),
        );

        $this->db->where('id_barang', $id);
        $this->db->update('tb_barang', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('tb_barang');
    }

    // end Fungsi Barang

    // fungsi User
    public function getLevel()
    {
        return $this->db->get('tb_level')->result_array();
    }

    public function getAllPetugas()
    {
        $query = "SELECT * FROM tb_petugas INNER JOIN tb_level ON tb_petugas.id_level = tb_level.id_level";
        return $this->db->query($query)->result_array();
    }

    public function getPetugasById($id)
    {
        return $this->db->get_where('tb_petugas', ['id_petugas' => $id])->row_array();
    }

    public function insertUser()
    {
        $data = array(
            'nama_petugas' => $this->input->post('nama_petugas'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'id_level' => $this->input->post('id_level'),
        );
        $this->db->insert('tb_petugas', $data);
    }

    public function updateUser($data, $id)
    {
        $this->db->where('id_petugas', $id);
        $this->db->update('tb_petugas', $data);
    }

    public function deleteUser($id)
    {
        $this->db->where('id_petugas', $id);
        $this->db->delete('tb_petugas');
    }

    //Fungsi Lelang

    public function getAllLelangData()
    {
        $query = "SELECT * FROM `tb_lelang` JOIN `tb_barang` ON tb_barang.id_barang = tb_lelang.id_barang WHERE tb_lelang.status = 'dibuka' OR tb_lelang.status = 'ditutup' ORDER BY tb_lelang.id_lelang DESC";
        return $this->db->query($query)->result_array();
    }

    //detail lelang
    public function getLelangDataById($id)
    {
        $query = "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang = tb_barang.id_barang WHERE tb_lelang.id_barang = '$id'";
        return $this->db->query($query)->row_array();
    }

    //Get user lelang barang
    public function getHistory($id)
    {
        $query = "SELECT history_lelang.penawaran_harga as penawaran_harga, tb_masyarakat.username as username FROM `history_lelang` INNER JOIN tb_masyarakat ON history_lelang.id_user = tb_masyarakat.id_user WHERE id_barang = '$id' ORDER BY penawaran_harga DESC";
        return $this->db->query($query)->result_array();
    }

    //status
    public function status($id, $data)
    {
        $this->db->where('id_lelang', $id);
        $this->db->update('tb_lelang', array('status' => $data));
        return true;
    }

    public function ht($id)
    {
        $query = "SELECT * FROM history_lelang INNER JOIN tb_masyarakat ON history_lelang.id_user = tb_masyarakat.id_user WHERE history_lelang.id_barang = '$id' ORDER BY penawaran_harga DESC LIMIT 1";
        return $this->db->query($query)->row_array();
    }

    public function akhiri_lelang()
    {
        $id = $this->input->post('id_lelang');
        $hg = $this->input->post('harga_akhir');
        $id_user = $this->input->post('id_user');
        $status = $this->input->post('status');

        $query = "UPDATE `tb_lelang` SET `harga_akhir`='$hg',`id_user`='$id_user',`status`='$status' WHERE `id_lelang`='$id'";
        $this->db->query($query);
        return true;
    }

    //fungsi Cetak
    public function dataCetak()
    {
        $query = "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang = tb_barang.id_barang ORDER BY tgl_lelang DESC";
        return $this->db->query($query)->result_array();
    }

    public function dataCetakById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_lelang');
        $this->db->join('tb_barang', 'tb_barang.id_barang=tb_lelang.id_barang');
        $this->db->join('tb_masyarakat', 'tb_masyarakat.id_user = tb_lelang.id_user');
        $this->db->where('tb_lelang.id_lelang', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function dataPemenang($id)
    {
        $query = "SELECT history_lelang.penawaran_harga as penawaran_harga, tb_masyarakat.username as username FROM `history_lelang` INNER JOIN tb_masyarakat ON history_lelang.id_user = tb_masyarakat.id_user WHERE id_lelang = '$id'";
        return $this->db->query($query)->result_array();
    }
}

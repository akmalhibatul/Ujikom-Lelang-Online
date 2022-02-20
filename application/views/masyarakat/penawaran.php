<!-- Page Heading -->
<?= $this->session->flashdata('msg'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lelang - <?= $barang['nama_barang']; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Barang : <?= $barang['nama_barang']; ?></h3>
                <h4>Harga Barang : <?= $barang['harga_awal']; ?></h4>
                <h4>Deskripsi : <?= $barang['deskripsi_barang']; ?></h4>
                <form action="<?= base_url() ?>masyarakat/tawar" method="POST">
                    <input type="text" name="id_lelang" value="<?= $barang['id_lelang']; ?>" hidden>
                    <input type="text" name="id_barang" value="<?= $barang['id_barang']; ?>" hidden>
                    <input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" hidden>
                    <div class="col-md-12 mt-3 mb-3">
                        <label for="">Masukan Harga :</label>
                        <input type="number" name="penawaran_harga" class="form-control" required>
                        <small class="form-text text-danger">Penawaran Harus Lebih Tinggi dari Harga Barang</small>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary" type="submit">Beri Tawaran</button>
                        <a href="<?= base_url() ?>masyarakat/index" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
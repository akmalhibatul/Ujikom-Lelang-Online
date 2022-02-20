<!-- Page Heading -->
<?= $this->session->flashdata('msg'); ?>
<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Barang : <?= $barang['nama_barang']; ?></h3>
                <h4>Deskripsi : <?= $barang['deskripsi_barang']; ?></h4>
                <form action="<?= base_url() ?>page/tawar" method="POST">
                    <input type="text" name="id_lelang" value="<?= $barang['id_lelang']; ?>" hidden>
                    <input type="text" name="id_barang" value="<?= $barang['id_barang']; ?>" hidden>
                    <input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" hidden>
                    <div class="col-md-12 mt-3 mb-3">
                        <?php if ($this->session->userdata('id_level') == '3') { ?>
                            <label for="">Masukan Harga :</label>
                            <input type="number" name="penawaran_harga" class="form-control" required>
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary" type="submit">Beri Tawaran</button>
                                <a href="<?= base_url() ?>page/index" class="btn btn-danger">Kembali</a>
                            </div>
                </form>
            <?php } else { ?>
                <div class="text-center mt-5">
                    <p>Ingin mengajukan harga ?</p>
                    <a href="<?= base_url() ?>auth">Masuk</a>
                    |
                    <a href="<?= base_url() ?>auth/registration">Daftar</a>
                </div>
            <?php } ?>
            </div>

        </div>
    </div>
</div>

</div>
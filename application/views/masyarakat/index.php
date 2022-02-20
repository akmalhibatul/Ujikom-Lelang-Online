<!-- Page Heading -->

<?= $this->session->flashdata('msg'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Barang Lelang</h1>
</div>

<!-- Content Row -->
<div class="row">
    <?php
    foreach ($barang as $b) :
    ?>
        <div class="col-lg-3 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4><?= $b['nama_barang']; ?></h4>
                    <p>Deskripsi : <?= $b['deskripsi_barang']; ?></p>
                    <form action="<?= base_url() ?>masyarakat/penawaran/<?= $b['id_barang']; ?>" method="POST">
                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Beri Penawaran</button>
                    </form>
                </div>
                <div class="card-footer">
                    <p>Close Bid : <?= $b['tgl']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
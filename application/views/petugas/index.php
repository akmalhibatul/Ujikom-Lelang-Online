<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Barang Lelang</h1>
</div>
<?= $this->session->flashdata('msg'); ?>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang</div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">Barang Lelang</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Nama Barang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($lelang as $l) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $l['tgl_lelang']; ?></td>
                                    <td><?= $l['nama_barang']; ?></td>
                                    <td><strong><?= $l['status']; ?></strong></td>
                                    <td><a href="<?= base_url() ?>petugas/detail/<?= $l['id_barang']; ?>" class="btn btn-primary btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
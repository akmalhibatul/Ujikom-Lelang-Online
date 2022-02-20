<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Barang Lelang</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail barang</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" class="form-control" value="<?= $lelang['nama_barang']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Harga Akhir</label>
                    <input type="text" class="form-control" value="???" readonly>
                </div>
                <div class="form-group">
                    <label for="">Berakhir Pada</label>
                    <input type="text" class="form-control" value="<?= $lelang['tgl_lelang']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi barang</label>
                    <input type="text" class="form-control" value="<?= $lelang['deskripsi_barang']; ?>" readonly>
                </div>
                <form action="<?= base_url() ?>petugas/status" method="POST">
                    <input type="text" name="id_lelang" value="<?= $lelang['id_lelang']; ?>" hidden>
                    <div class="form-group">
                        <label for="">Status</label>
                        <?php $s = $lelang['status'] ?>
                        <select name="status" class="custom-select">
                            <option <?= $s == 'dibuka' ? "selected" : "" ?> value="dibuka">dibuka</option>
                            <option <?= $s == 'ditutup' ? "selected" : "" ?> value="ditutup">ditutup</option>
                        </select>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                        <a href="<?= base_url() ?>petugas/akhir/<?= $lelang['id_barang']; ?>" class="btn btn-danger">Akhiri Lelang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">History Penawaran</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>Penawaran Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rank = 1;
                            foreach ($history as $h) :
                            ?>
                                <tr>
                                    <td><?= $rank++; ?></td>
                                    <td><?= $h['username']; ?></td>
                                    <td><?= $h['penawaran_harga']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
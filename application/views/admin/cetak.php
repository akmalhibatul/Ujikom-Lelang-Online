                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Cetak Data Lelang</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data lelang</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Tanggal</th>
                                            <th>Harga Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($cetak as $c) :
                                        ?>
                                            <tr>
                                                <td><?= $c['nama_barang']; ?></td>
                                                <td><?= $c['tgl_lelang']; ?></td>
                                                <td><?= "Rp" . number_format($c['harga_akhir'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="<?= base_url() ?>admin/cetak_pdf/<?= $c['id_lelang']; ?>" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-print "></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
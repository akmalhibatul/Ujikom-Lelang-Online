                    <!-- Page Heading -->
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?= $this->session->flashdata('msg'); ?>
                    <?php endif; ?>
                    
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Barang</h1>
                        <a href="<?= base_url() ?>admin/tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Tambah Barang</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <th>Nama Barang</th>
                                            <th>Tanggal</th>
                                            <th>Harga Awal</th>
                                            <th>Deskripsi Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($barang as $b) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $b['nama_barang']; ?></td>
                                                <td><?= $b['tgl']; ?></td>
                                                <td><?= "Rp" . number_format($b['harga_awal'], 2, ',', '.'); ?></td>
                                                <td><?= $b['deskripsi_barang']; ?></td>
                                                <td>
                                                    <a href="<?= base_url() ?>admin/edit/<?= $b['id_barang']; ?>" class="btn btn-primary btn-circle">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url() ?>admin/delete/<?= $b['id_barang']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah anda yakin?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
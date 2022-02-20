                    <!-- Page Heading -->
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?= $this->session->flashdata('msg'); ?>
                    <?php endif; ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
                        <a href="<?= base_url() ?>admin/tambah_user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Tambah User</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Petugas</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($petugas as $p) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $p['nama_petugas']; ?></td>
                                                <td><?= $p['username']; ?></td>
                                                <td><?= $p['password']; ?></td>
                                                <th><?= $p['level']; ?></th>
                                                <td>
                                                    <a href="<?= base_url() ?>admin/delete_user/<?= $p['id_petugas']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah anda yakin?')">
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?= base_url() ?>admin/user" class="btn btn-danger">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>admin/add_user" method="post">
                                <div class="col-md-12 mb-3">
                                    <label for="">Nama Petugas</label>
                                    <input type="text" class="form-control" name="nama_petugas">
                                    <small class="form-text text-danger"><?= form_error('nama_petugas'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username">
                                    <small class="form-text text-danger"><?= form_error('username'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" name="password">
                                    <small class="form-text text-danger"><?= form_error('password'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <label for="">Level</label>
                                    <select name="id_level" class="custom-select">
                                        <?php foreach ($level as $l) : ?>
                                            <option value="<?= $l['id_level']; ?>"><?= $l['level']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger"><?= form_error('deskripsi_barang'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
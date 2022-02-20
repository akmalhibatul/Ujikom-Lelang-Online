                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?= base_url() ?>petugas/barang" class="btn btn-danger">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>petugas/update" method="post">
                                <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
                                <div class="col-md-12 mb3">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" value="<?= $barang['nama_barang']; ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_barang'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb3">
                                    <label for="">Tanggal Lelang</label>
                                    <input type="date" class="form-control" name="tgl" value="<?= $barang['tgl']; ?>">
                                    <small class="form-text text-danger"><?= form_error('tgl'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb3">
                                    <label for="">Harga Awal</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="harga_awal" value="<?= $barang['harga_awal']; ?>">
                                    </div>
                                    <small class="form-text text-danger"><?= form_error('harga_awal'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb3">
                                    <label for="">Deskripsi Barang</label>
                                    <textarea name="deskripsi_barang" class="form-control"><?= $barang['deskripsi_barang']; ?></textarea>
                                    <small class="form-text text-danger"><?= form_error('deskripsi_barang'); ?></small>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
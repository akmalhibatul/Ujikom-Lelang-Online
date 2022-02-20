<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?= base_url() ?>admin/barang" class="btn btn-danger">Kembali</a>
    </div>
    <div class="card-body">
        <form action="<?= base_url() ?>admin/create" method="post">
            <div class="col-md-12 mb3">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang">
                <small class="form-text text-danger"><?= form_error('nama_barang'); ?></small>
            </div>
            <div class="col-md-12 mt-3 mb3">
                <label for="">Tanggal Lelang</label>
                <input type="date" class="form-control" name="tgl">
                <small class="form-text text-danger"><?= form_error('tgl'); ?></small>
            </div>
            <div class="col-md-12 mt-3 mb3">
                <label for="prince">Harga Barang</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="harga_awal">
                </div>
                <small class="form-text text-danger"><?= form_error('harga_awal'); ?></small>
            </div>
            <div class="col-md-12 mt-3 mb3">
                <label for="">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" class="form-control"></textarea>
                <small class="form-text text-danger"><?= form_error('deskripsi_barang'); ?></small>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>

        </form>
    </div>
</div>
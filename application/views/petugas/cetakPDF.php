<label><b>Nama Barang</b></label>
<div><?= $cetak['nama_barang'] ?></div><br>

<label><b>Harga</b></label>
<div><?= "Rp" . number_format($cetak['harga_akhir'], 2, ',', '.'); ?></div><br>

<label><b>Deskripsi</b></label>
<div><?= $cetak['deskripsi_barang'] ?></div><br>

<label><b>Pemenang</b></label>:

<label><b>Nama</b></label>
<div><?= $cetak['nama_lengkap'] ?></div><br>

<label><b>No Telp</b></label>
<div><?= $cetak['telp'] ?></div><br>

<h4 align="center">Tabel Riwayat Pengajuan</h4>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Username</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($history as $row) : ?>
            <tr>
                <td><?= $row['username'] ?></td>
                <td><?= "Rp" . number_format($row['penawaran_harga'], 2, ',', '.'); ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    window.print();
</script>
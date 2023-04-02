<h2 style="text-align:center;">Daftar Rumah</h2>
<div class="center">
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    <?= $this->session->flashdata('pesan'); ?>
    <button id="myBtn" class="btn success">Tambah Rumah</button>
    <a href="<?= base_url('sewa/export_excel_sewa'); ?>" class="btn success">Excel</a>
    <a href="<?= base_url('sewa/cetak_laporan_sewa'); ?>" class="btn warning">Print</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Luas Bangunan</th>
                <th scope="col">Luas Tanah</th>
                <th scope="col">Listrik</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Harga</th>
                <th scope="col">Durasi</th>
                <th scope="col">Stok</th>
                <th scope="col">Ditempati</th>
                <th scope="col">Dibooking</th>
                <th scope="col">Foto</th>
                <th scope="col">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 1;
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $idku =  $user['id'];
            foreach ($sewa as $k)
                if ($user['role_id'] == 1) {
            ?>
                <tr>
                    <th><?= $a++; ?></th>
                    <td><?= $k['luas_b']; ?></td>
                    <td><?= $k['luas_t']; ?></td>
                    <td><?= $k['listrik']; ?></td>
                    <td><?= $k['deskripsi']; ?></td>
                    <td><?= $k['alamat']; ?></td>
                    <td><?= $k['no_telp']; ?></td>
                    <td><?= $k['harga']; ?></td>
                    <td><?= $k['durasi']; ?> Hari</td>
                    <td><?= $k['stok']; ?></td>
                    <td><?= $k['ditempati']; ?></td>
                    <td scope="col"><?= $k['dibooking']; ?></td>
                    <td scope="col">
                        <picture>
                            <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" width="100" height="70" alt="...">
                        </picture>
                    </td>
                    <td scope="col">
                        <a href="<?= base_url('sewa/ubahSewa/') . $k['id']; ?>" class="badge badge-success">Ubah</a>
                        <a href="<?= base_url('sewa/hapusKontrak/') . $k['id']; ?>" class="badge badge-danger">Hapus</a>
                    </td>
                </tr>
                <?php } else {
                    if ($k['id_user'] == $idku) {  ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $k['luas_b']; ?></td>
                        <td><?= $k['luas_t']; ?></td>
                        <td><?= $k['listrik']; ?></td>
                        <td><?= $k['deskripsi']; ?></td>
                        <td><?= $k['alamat']; ?></td>
                        <td><?= $k['no_telp']; ?></td>
                        <td><?= $k['harga']; ?></td>
                        <td><?= $k['durasi']; ?> Hari</td>
                        <td><?= $k['stok']; ?></td>
                        <td><?= $k['ditempati']; ?></td>
                        <td scope="col"><?= $k['dibooking']; ?></td>
                        <td scope="col">
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" width="100" height="70" alt="...">
                            </picture>
                        </td>
                        <td scope="col">
                            <a href="<?= base_url('sewa/ubahSewa/') . $k['id']; ?>" class="badge badge-success">Ubah</a>
                            <a href="<?= base_url('sewa/hapusKontrak/') . $k['id']; ?>" class="badge badge-danger">Hapus</a>
                        </td>
                    </tr>
            <?php }
                }
            ?>
        </tbody>
    </table>
</div>


<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Tambah Kontrakan</p>
        <form action="<?= base_url('sewa'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" class="form-login" id="luas_b" name="luas_b" placeholder="Masukkan luas bangunan">
                <input type="text" class="form-login" id="luas_t" name="luas_t" placeholder="Masukkan luas tanah">
                <input type="text" class="form-login" id="listrik" name="listrik" placeholder="Masukkan watt listrik">
                <input type="text" class="form-login" id="alamat" name="alamat" placeholder="Masukkan Alamat Rumah Lengkap">
                <input type="text" class="form-login" id="no_telp" name="no_telp" placeholder="Masukkan No Telepon">
                <input type="text" class="form-login" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
                <input type="text" class="form-login" id="harga" name="harga" placeholder="Masukkan Harga">
                <select class="form-login" id="durasi" name="durasi" required>
                    <option>Silahkan Pilih Lama Waktu Penyewaan Rumah</option>
                    <option value="30">Sebulan</option>
                    <option value="365">Setahun</option>
                </select>
                <input type="text" class="form-login" id="stok" name="stok" placeholder="Masukkan Stok">
                <input type="file" class="form-login" id="image" name="image">
                <input type="file" class="form-login" id="image2" name="image2">
                <input type="file" class="form-login" id="image3" name="image3">
            </div>
            <button type="submit" class="tombol_daftar">Confirm</button>
        </form>
    </div>
</div>
<div class="center">
    <h1 style="text-align: center;">Informasi Pemesanan</h1>

    <?php
    foreach ($items as $i) {
        $id = $i['id_pemilik'];
        $pemilik = $this->db->query("select nama from user where id='$id'")->row_array(); ?>
        <table>
            <tr>
                <th>Pemilik Rumah</th>
                <th colspan="2">: <?= $pemilik['nama']; ?></th>
                <th>
                    <img src="<?= base_url('assets/img/upload/') . $i['image']; ?>" alt="..." width="220px" height="150px">
                </th>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <th colspan="3">: <?= $i['deskripsi']; ?></th>
            </tr>
            <tr>
                <th>Luas Bangunan</th>
                <td>: <?= $i['luas_b']; ?></td>
                <th>Luas Tanah</th>
                <td>: <?= $i['luas_t']; ?></td>

            </tr>
            <tr>
                <th>Alamat</th>
                <td>: <?= $i['alamat']; ?></td>
                <th>No Telepon</th>
                <td>: <?= $i['no_telp']; ?></td>

            </tr>
            <tr>
                <th>Listrik</th>
                <td>: <?= $i['listrik']; ?></td>
                <th>Harga</th>
                <td>: Rp. <?= number_format($i['harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>No. Booking</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
            </tr>
            <tr>
                <td><?= $i['id_booking'] ?></td>
                <td><?= $i['tgl_booking'] ?></td>
                <td><?= $i['batas_ambil'] ?></td>
                <td><?= date('Y-m-d', strtotime('+' . $i['durasi'] . ' days', strtotime($i['batas_ambil'])))  ?>
            </tr>
        </table>
        <h1>Biaya Booking : Rp. <?= number_format(($i['harga'] * 0.1), 0, ',', '.'); ?>
        </h1>
    <?php } ?>
    <div style="margin:auto">
        <form action="<?= base_url('booking/transfer'); ?>" method="post" enctype="multipart/form-data">
            <label>Nama</label>
            <input value="<?= set_value('nama', $pengguna['nama']); ?>" type="text" class="form-login" id="nama_rek" name="nama_rek" placeholder="Masukkan nama_rek">
            <?= form_error('nama_rek'); ?>
            <label>Email Anda</label>
            <input value="<?= set_value('email', $pengguna['email']); ?>" type="text" class="form-login" id="email" name="email" readonly>
            <?= form_error('email'); ?>
            <label>No Telepon Anda</label>
            <input value="<?= set_value('no_telp', $pengguna['no_telp']); ?>" type="text" class="form-login" id="no_telp" name="no_telp">
            <?= form_error('no_telp'); ?>
            <label>No Rekening</label>
            <input type="text" class="form-login" id="no_rek" name="no_rek" placeholder="Masukkan nama no_rek">
            <?= form_error('no_rek'); ?>
            <label>Nama Bank</label>
            <input type="text" class="form-login" id="bank_rek" name="bank_rek" placeholder="Masukkan nama bank_rek">
            <?= form_error('bank_rek'); ?>
            <label>Bukti Transfer</label>
            <br>
            <input type="file" class="form-login" id="bukti" name="bukti">
            <button type="submit" class="tombol_daftar">Confirm</button>
        </form>
    </div>
</div>
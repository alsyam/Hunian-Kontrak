<div class="center">
    <h1 style="text-align: center;">Detail Pemesanan</h1>
    <?php
    // $user = $pemesan['id_user'];
    $rek = $this->db->query("select*from rekening where id_booking='$booking'")->row_array();
    $idku = $rek['id_pemesan'];
    $user = $this->db->query("select*from user where id='$idku'")->row_array();
    ?>
    <h3 class="left">
        Nama : <?= $rek['nama_rek']; ?>
    </h3>
    <h3>
        Bank : <?= $rek['bank_rek']; ?>
    </h3>
    <h3>
        No. Rekening : <?= $rek['no_rek']; ?>
    </h3>
    <h3>
        No. Telepon : <?= $user['no_telp']; ?>
    </h3>
    <h3>
        <img src="<?= base_url('assets/img/bukti/') . $rek['bukti']; ?>" alt="..." width="220px" height="300px">
    </h3>

    <?php foreach ($items as $i) {
        $id = $i['id_pemilik'];
        $pemilik = $this->db->query("select nama from user where id='$id'")->row_array(); ?>
        <h1>DP Terbayar : Rp. <?= number_format(($i['harga'] * 0.1), 0, ',', '.'); ?>
        </h1>
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
                <td><?= date('Y-m-d', strtotime('+' . 365 . ' days', strtotime($i['batas_ambil'])))  ?>
            </tr>
        </table>
    <?php } ?>
    <br>
    <br>
    <a href="<?= base_url('pesan/daftarBooking/'); ?>" class="btn success">Kembali</a>
    <br>
    <br>

</div>
<h2 style="text-align: center">Rumah Yang Akan di Pesan</h2>
<div class="center">
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    <?= $this->session->flashdata('pesan'); ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Luas Bangunan</th>
                <th>Luas Tanah</th>
                <th>Listrik</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Pesan untuk waktu?</th>
                <th>Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 1;
            foreach ($tempo as $t) { ?>
                <tr>
                    <th scope="row"><?= $a++; ?></th>
                    <td><?= $t['luas_b']; ?></td>
                    <td><?= $t['luas_t']; ?></td>
                    <td><?= $t['listrik']; ?></td>
                    <td><?= $t['deskripsi']; ?></td>
                    <td><?= $t['alamat']; ?></td>
                    <td><?= $t['no_telp']; ?></td>
                    <td>Rp. <?= number_format($t['harga'], 0, ',', '.'); ?>/<?= $t['durasi']; ?> Hari</td>
                    <td scope="col">
                        <picture>
                            <source srcset="" type="image/svg+xml">
                            <img src="<?= base_url('assets/img/upload/') . $t['image']; ?>" width="100" height="70" alt="...">
                        </picture>
                    </td>

                    <form action="<?= base_url('booking/bookingSelesai/' . $t['id_user']); ?>" method="post">
                        <td class="btn warning">
                            <h2 style="text-align:center;color:red;">Harus diisi</h2>
                            <input style="width:140px" type="date" name="waktu" id="waktu" value="null">
                            <?= form_error('waktu'); ?>
                        </td>
                        <td scope="col">
                            <a href="<?= base_url('booking/hapusBooking/') . $t['id_kontrak']; ?>" class="btn danger">Hapus</a>
                        </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <!-- <a type="submit" class="btn info" href="<?php echo base_url() . 'booking/bookingSelesai/' . $t['id_user']; ?>">Selesaikan Booking</a> -->
    <td nowrap>
        <button type="submit" class="btn info">Selesaikan Booking</button>
    </td>
    </form>
    <br>
    <br>
    <br>
</div>
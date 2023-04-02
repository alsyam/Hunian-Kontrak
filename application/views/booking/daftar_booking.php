<div class="center">
    <table>
        <tr>
            <!-- <?php foreach ($kontrak as $k) : ?>
                <th><?= $kontrak['alamat']; ?></th>
            <?php endforeach; ?> -->

            <th>No</th>
            <th>ID Booking</th>
            <th>Tanggal Booking</th>
            <th>ID User</th>
            <th>Aksi</th>
            <th>Lama Pinjam</th>
            <th>Detail Booking</th>
            <th>Hapus Booking</th>
        </tr>
        <?php
        $no = 1;
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];
        foreach ($pesan as $p)
            if ($user['role_id'] == 1) {
        ?>
            <tr>
                <th><?= $no; ?></th>
                <td><?= $p['id_booking']; ?></a></td>
                <td><?= $p['tgl_booking']; ?></td>
                <td><?= $p['nama']; ?></td>
                <form action="<?= base_url('pesan/pesanAct/' . $p['id_booking']); ?>" method="post">
                    <td nowrap>
                        <button type="submit" class="btn warning"><i class="fas fa-fw fa-cart-plus"></i> Pesan</button>
                    </td>

                    <td>
                        <input style="width:100px" type="text" name="lama" id="lama" value="<?= $p['durasi']; ?>" readonly>
                        <?= form_error('lama'); ?>
                    <td scope="col" class=" text-right">
                        <a href="<?= base_url('pesan/bookingDetail/') . $p['id_booking']; ?>" class="btn success">Detail</a>
                    </td>
                </form>
            </tr>
            <?php } else {
                if ($p['id_pemilik'] == $idku) { { ?>
                    <tr>
                        <th><?= $no; ?></th>
                        <td><?= $p['id_booking']; ?></a></td>
                        <td><?= $p['tgl_booking']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <form action="<?= base_url('pesan/pesanAct/' . $p['id_booking']); ?>" method="post">
                            <td nowrap>
                                <button type="submit" class="btn warning"><i class="fas fa-fw fa-cart-plus"></i> Pesan</button>
                            </td>
                            <td>
                                <input style="width:100px" type="text" name="lama" id="lama" value="<?= $p['durasi']; ?>" readonly>
                                <?= form_error('lama'); ?>
                        </form>
                        <td scope="col" class=" text-right">
                            <a href="<?= base_url('pesan/bookingDetail/') . $p['id_booking']; ?>" class="btn success">Detail</a>
                        </td>
                        <td scope="col" class=" text-right">
                            <a href="<?= base_url('pesan/hapusBooking/') . $p['id_booking']; ?>" class="btn danger">Hapus</a>
                        </td>
                    </tr>
        <?php $no++;
                    }
                }
            } ?>
    </table>
</div>
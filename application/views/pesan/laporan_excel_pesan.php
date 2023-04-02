<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<h3>
    <center>Laporan Data Penyewaan Rumah</center>
</h3>
<br />
<table class="table-data">
    <thead>
        <h3>
            Laporan Data Penyewaan Rumah
        </h3>
    </thead>
    <br>
    <table class="table-data">
        <thead>
            <tr>
                <th>No Pesan</th>
                <th>Tanggal Pesan</th>
                <th>Penyewa</th>
                <th>Rumah</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Keluar</th>
                <th>Tanggal Pengembalian</th>
                <th>Terlambat</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];
        foreach ($laporan as $p)
            if ($user['role_id'] == 1) {
        ?>
            <tbody>
                <tr>
                    <td><?= $p['no_pesan']; ?></td>
                    <td><?= $p['tgl_pesan']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td scope="col">
                        <picture>
                            <img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" width="100" height="70" alt="...">
                        </picture>
                    </td>
                    <td><?= $p['w_mulai']; ?></td>
                    <td><?= $p['tgl_kembali']; ?></td>
                    <td><?= $p['tgl_pengembalian']; ?></td>
                    <!-- <td>
                                                            <?= date('Y-m-d'); ?>
                                                            <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                                        </td> -->
                    <td>
                        <?php
                        $tgl1 = new DateTime($p['tgl_kembali']);
                        $tgl2 = new DateTime($p['w_mulai']);
                        $selisih = $tgl2->diff($tgl1)->format("%a");
                        echo $selisih;
                        ?> Hari
                    </td>
                    <?php if ($p['status'] == "Ditempati") {
                        $status = "btn warning";
                    } else {
                        $status = "btn danger";
                    } ?>
                    <td><i class="btn btn-outline-primary<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td>

                </tr>
            </tbody>
            <?php } else {
                if ($p['id_pemilik'] == $idku) {  ?>
                <tbody>
                    <tr>
                        <td><?= $p['no_pesan']; ?></td>
                        <td><?= $p['tgl_pesan']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td scope="col">
                            <picture>
                                <img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" width="100" height="70" alt="...">
                            </picture>
                        </td>
                        <td><?= $p['w_mulai']; ?></td>
                        <td><?= $p['tgl_kembali']; ?></td>
                        <td><?= $p['tgl_pengembalian']; ?></td>
                        <!-- <td>
                                                            <?= date('Y-m-d'); ?>
                                                            <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                                        </td> -->
                        <td>
                            <?php
                            $tgl1 = new DateTime($p['tgl_kembali']);
                            $tgl2 = new DateTime($p['w_mulai']);
                            $selisih = $tgl2->diff($tgl1)->format("%a");
                            echo $selisih;
                            ?> Hari
                        </td>
                        <?php if ($p['status'] == "Ditempati") {
                            $status = "btn warning";
                        } else {
                            $status = "btn danger";
                        } ?>
                        <td><i class="btn btn-outline-primary<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td>
                    </tr>
                </tbody>
        <?php
                }
            }
        ?>
    </table>
</table>
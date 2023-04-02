<h2 style="text-align:center;">Daftar Pesan</h2>
<div class="center">

    <a href="<?= base_url('pesan/export_excel_pesan'); ?>" class="btn success">Excel</a>
    <a href="<?= base_url('pesan/cetak_laporan_pesan'); ?>" class="btn warning">Print</a>
    <br><br>
    <table class="table table-bordered table-striped table-hover" id="table-datatable">
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
            <th>Konfirmasi Penyewa</th>
            <th>Pilihan</th>
        </tr>
        <?php
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $idku =  $user['id'];
        foreach ($pesan as $p)
            if ($user['role_id'] == 1) {
        ?>
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

                <td nowrap>
                    <?php if ($p['status'] == "Kosong") { ?>
                        <i class="btn default"><i class="fas fa-fw fa-edit"></i>Ubah Status</i>
                    <?php } else { ?>
                        <a class="btn info" href="<?= base_url('pesan/ubahStatus/' . $p['id_kontrak'] . '/' . $p['no_pesan']); ?>"><i class="fas fa-fw fa-edit"></i>Ubah Status</a>
                    <?php } ?>
                </td>
                </td>
                <?php if ($p['status_konfir'] == "Sudah menempati") {
                    $status_konfir = "btn warning";
                } else {
                    $status_konfir = "btn danger";
                } ?>
                <td><i class="btn btn-outline-primary<?= $status_konfir; ?> btn-sm"><?= $p['status_konfir']; ?></i></td>
            </tr>
            <?php } else {
                if ($p['id_pemilik'] == $idku) {  ?>
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

                    <td nowrap>
                        <?php if ($p['status'] == "Kosong") { ?>
                            <i class="btn default"><i class="fas fa-fw fa-edit"></i>Ubah Status</i>
                        <?php } else { ?>
                            <a class="btn info" href="<?= base_url('pesan/ubahStatus/' . $p['id_kontrak'] . '/' . $p['no_pesan']); ?>"><i class="fas fa-fw fa-edit"></i>Ubah Status</a>
                        <?php } ?>
                    </td>
                    <?php if ($p['status_konfir'] == "Sudah menempati") {
                        $status_konfir = "btn warning";
                    } else {
                        $status_konfir = "btn danger";
                    } ?>
                    <td><i class="btn btn-outline-primary<?= $status_konfir; ?> btn-sm"><?= $p['status_konfir']; ?></i></td>
                </tr>
        <?php
                }
            }
        ?>
    </table>
</div>
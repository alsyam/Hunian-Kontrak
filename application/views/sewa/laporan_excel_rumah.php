<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<h3>
    <center>Laporan Data Rumah</center>
</h3>
<br />
<table class="table-data">
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
                </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>
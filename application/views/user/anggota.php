<h2 style="text-align:center;">Anggota</h2>
<div class="center">
    <a href="<?= base_url('user/export_excel_anggota'); ?>" class="btn success">Excel</a>
    <a href="<?= base_url('user/cetak_laporan_anggota'); ?>" class="btn warning">Print</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Email</th>
                <th scope="col">No. Telepon</th>
                <th scope="col">Role</th>
                <th scope="col">Bergabung Sejak</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $n = 1;
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $idku =  $user['id'];
            foreach ($anggota as $a)
                if ($user['role_id'] == 1) { ?>
                <tr>
                    <th><?= $n++; ?></th>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['alamat']; ?></td>
                    <td><?= $a['email']; ?></td>
                    <td><?= $a['no_telp']; ?></td>
                    <td><?= $a['role']; ?></td>
                    <td><?= $a['tanggal_input']; ?></td>
                    <td>
                        <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" width="100" height="110">
                    </td>
                </tr>
            <?php }
            foreach ($pesan as $p)
                if ($p['id_pemilik'] == $idku) { ?>
                <tr>
                    <th><?= $n++; ?></th>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <td><?= $p['email']; ?></td>
                    <td><?= $p['no_telp']; ?></td>
                    <td><?= $p['role']; ?></td>
                    <td><?= $p['tanggal_input']; ?></td>
                    <td>
                        <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" width="100" height="110">
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>
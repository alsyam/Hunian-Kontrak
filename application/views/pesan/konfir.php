<h2 style="text-align:center;">Info Konfirmasi Rumah</h2>
<div class="center">
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Pesan</th>
                <th scope="col">ID User</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 1;
            foreach ($konfirmasi as $k) {
            ?>
                <tr>
                    <th><?= $a++; ?></th>
                    <td><?= $k['no_pesan']; ?></td>
                    <td><?= $k['id_user']; ?></td>
                    <td><?= $k['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
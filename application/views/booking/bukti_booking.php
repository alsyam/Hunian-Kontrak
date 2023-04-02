<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hunian Kontrak | <?= $judul; ?></title>
    <link rel="icon" href="<?php echo base_url() ?>assets/foto/hunian.jpg" type="image/x-icon">
</head>

<body>
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap");

        body {
            font-family: "Quicksand", sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 2px solid orange;
            font-size: 12pt;
            font-family: sans-serif;
            padding: 10px 10px 10px 10px;
        }

        h1 {
            font-family: Verdana;
        }

        h5 {
            font-family: Verdana;
        }

        i {
            color: orangered;
            font-weight: bold;
        }

        footer {
            color: orangered;
            font-weight: bold;
            text-align: center;
            bottom: 0px;
        }



        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .justify {
            text-align: justify;
        }
    </style>
    <p>
    <div class="center">
        <h1 style="color: orangered;">Hunian Kontrak</h1>
        <h3>Bukti Pemesanan Rumah</h3>
        <h4><?= (date('d M Y H:i:s')); ?></h4>
    </div>
    </p>
    <hr>
    <br>
    <br>

    <h3 class="left">
        Nama : <?= $pengguna['nama']; ?>
    </h3>
    <h3>
        Email : <?= $pengguna['email']; ?>
    </h3>
    <h3>
        No Telepon : <?= $pengguna['no_telp']; ?>
    </h3>
    <h3>
        Bank : <?= $rek['bank_rek']; ?>
    </h3>
    <h3>
        No. Rekening : <?= $rek['no_rek']; ?>
    </h3>
    <?php
    foreach ($items as $i) {
        $id = $i['id_pemilik'];
        $pemilik = $this->db->query("select nama from user where id='$id'")->row_array(); ?>
        <h2 style="color: orangered;"><i> Terbayar : Rp. <?= number_format(($i['harga'] * 0.1), 0, ',', '.'); ?>
            </i></h2>
        <table class="table-data">

            <tr>
                <th class='left'>Pemilik Rumah</th>
                <th class='left' colspan="2"> <?= $pemilik['nama']; ?></th>
                <th>
                    <img src="<?= base_url('assets/img/upload/') . $i['image']; ?>" alt="..." width="220px" height="150px">
                </th>
            </tr>
            <tr>
                <th class='left'>Deskripsi</th>
                <th class='left' colspan="3"> <?= $i['deskripsi']; ?></th>
            </tr>
            <tr>
                <th class='left'>Luas Bangunan</th>
                <td> <?= $i['luas_b']; ?></td>
                <th class='left'>Luas Tanah</th>
                <td> <?= $i['luas_t']; ?></td>

            </tr>
            <tr>
                <th class='left'>Alamat</th>
                <td> <?= $i['alamat']; ?></td>
                <th class='left'>No Telepon</th>
                <td> <?= $i['no_telp']; ?></td>

            </tr>
            <tr>
                <th class='left'>Listrik</th>
                <td> <?= $i['listrik']; ?></td>
                <th class='left'>Harga</th>
                <td> Rp. <?= number_format($i['harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>No. Booking</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
            </tr>
            <tr>
                <td class="center"><?= $i['id_booking'] ?></td>
                <td class="center"><?= $i['tgl_booking'] ?></td>
                <td class="center"><?= $i['batas_ambil'] ?></td>
                <td class="center"><?= date('Y-m-d', strtotime('+' . $i['durasi'] . ' days', strtotime($i['batas_ambil'])))  ?>
            </tr>
        </table>

    <?php } ?>
    <script type="text/javascript">
        window.print();
    </script>
</body>
<br>
<br>
<footer>
    <p>Hunian Kontrak &#169; 2021, Muhammad Alsyam</p>

</footer>

</html>
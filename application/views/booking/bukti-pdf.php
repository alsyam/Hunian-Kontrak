<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px 10px 10px 10px;
        }

        h1 {
            font-family: Verdana;
        }

        h5 {
            font-family: Verdana;
        }

        i {
            color: #00FF7F;
            font-weight: bold;
            font-style: oblique;
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
    <h1>
        <div class="center">
            <i>KOSANKU</i>
            <h5>Bukti Pemesanan Kos</h5>
        </div>
    </h1>
    <hr>
    <br>
    <br>

    <h3 class="left">
        Nama Pemesan: <?= $user; ?>
        <br>
        <?= (date('d M Y H:i:s')); ?>
    </h3>
    <br>
    <br>
    <h4>Kos yang dipesan:</h4>
    <table class="table-data">
        <thead>
            <tr>
                <th>Nomor Booking</th>
                <th>Kategori</th>
                <th>Alamat</th>
                <th>Penjaga</th>
                <th>Fasilitas</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($items as $b) {
            ?>
                <tr>
                    <td><?= $b['id_booking']; ?></td>
                    <td><?= $b['alamat']; ?></td>
                    <td><?= $b['harga']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
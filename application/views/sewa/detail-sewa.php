<div class="slideshow-container">

    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="<?= base_url('assets/img/upload/') . $image; ?>" style="width:100%">
        <div class="text">Caption Text</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="<?= base_url('assets/img/upload/') . $image2; ?>" style="width:100%">
        <div class="text">Caption Two</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="<?= base_url('assets/img/upload/') . $image3; ?>" style="width:100%">
        <div class="text">Caption Three</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>

<div class="center">
    <table>
        <tr>
            <th>Deskripsi</th>
            <th colspan="4">: <?= $deskripsi; ?></th>
        </tr>
        <tr>
            <th>Luas Bangunan</th>
            <th>: <?= $luas_b; ?></th>
            <th>Luas Tanah</th>
            <th>: <?= $luas_t; ?></th>
            <th>Listrik</th>
            <th>: <?= $listrik; ?></th>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>: <?= $alamat; ?></th>
            <th>No Telepon</th>
            <th>: <?= $no_telp; ?></th>
            <th>Harga</th>
            <th>: <?= $no_telp; ?></th>
        </tr>
        <tr>
            <th>Stok</th>
            <th>: <?= $stok; ?></th>
            <th>Ditempati</th>
            <th>: <?= $ditempati; ?></th>
            <th>Dibooking</th>
            <th>: <?= $dibooking; ?></th>
        </tr>
    </table>
    <br>
    <a href="<?= base_url('booking/tambahBooking/') . $id; ?>" class="btn success">Pesan</a>
    <a href="<?= base_url('home/'); ?>" class="btn danger">Kembali</a>
    <br>
    <br>
</div>
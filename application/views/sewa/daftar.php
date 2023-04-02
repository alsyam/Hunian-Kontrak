<div class="row" style="padding : 40px">

    <h1 style="text-align:center">RUMAH</h1>
    <?php
    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $idku = $user['id'];
    if ($this->db->query("select*from rekening where id_pemesan='$idku'")->num_rows() > 0) { ?>
        <a href="<?= base_url('booking/cetak_bukti'); ?>" class="btn warning">CETAK BUKTI PEMESANAN DISINI!</a>
    <?php } elseif ($this->db->query("select*from booking where id_user='$idku'")->num_rows() > 0) { ?>
        <a href="<?= base_url('booking/transfer'); ?>" class="btn danger">SEGERA TRANSFER DISINI!</a>
    <?php } elseif ($this->db->query("select*from konfirmasi where id_user='$idku'")->num_rows() < 0) { ?>

    <?php } elseif ($this->db->query("select*from konfirmasi where id_user='$idku'")->num_rows() > 0) { ?>
        <a href="<?= base_url('home/konfirmasi'); ?>" class="btn danger">KLIK INI, JIKA ANDA TELAH MENEMPATI RUMAH!</a>
    <?php }; ?>
    <br style="margin-top: 20px;">
    <?= $this->session->flashdata('pesan'); ?>
    <?php
    foreach ($sewa as $s)
        if ($s->stok > 0) { { ?>
            <div class="column" style="margin-top: 30px;">
                <div class="card">
                    <img src="<?= base_url('assets/img/upload/') . $s->image; ?>" alt="..." style="width:100%" height="350px">
                    <div class="container">
                        <h2>Rp. <?= number_format($s->harga, 0, ',', '.'); ?>/<?= $s->durasi; ?> Hari</h2>
                        <p class="title">Lokasi : <?= $s->alamat; ?></p>
                        <p>Luas Bangunan : <?= $s->luas_b; ?></p>
                        <p>Luas Tanah : <?= $s->luas_t; ?></p>
                        <p>Kontak : <?= $s->no_telp; ?></p>
                        <p>Stok : <?= $s->stok; ?></p>
                        <p>
                            <a href="<?= base_url('booking/tambahBooking/' . $s->id); ?>" class="button">Pesan</a>

                        </p>
                        <p>
                            <a href="<?= base_url('home/detailSewa/' . $s->id); ?>" class="button">Detail</a>
                        </p>
                    </div>
                </div>
            </div>
    <?php }
        } ?>
</div>




<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-daftar">
        <span class="close">&times;</span>
        <p>Daftar Sebagai...</p>
        <br>
        <a href="<?= base_url('auth/regisPemilik'); ?>" class="btn success">Pengiklan</a>
        <a href="<?= base_url('auth/registrasi'); ?>" class="btn warning">Mencari Rumah</a>
        <br>
    </div>
</div>
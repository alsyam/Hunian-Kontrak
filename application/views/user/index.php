<div class="row" style="padding : 40px">

    <h2 style="text-align:center">Profil</h2>

    <?php
    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $this->session->flashdata('pesan');
    ?>
    <div class="card-p">
        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="John" style="width:100%">
        <h1><?= $user['nama']; ?></h1>
        <p class="title-p"><?= $user['alamat']; ?></p>
        <p><b><?= $user['no_telp']; ?></b></p>
        <p><b>Jadi member sejak: <?= date('d F Y', $user['tanggal_input']); ?></b></p>
        <div style="margin: 24px 0;">
        </div>
        <p>
            <a href="<?= base_url('user/ubahprofil'); ?>" class="button">Edit</a>
        </p>
    </div>
</div>
<nav>
    <ul>
        <?php
        if (!empty($this->session->userdata('email'))) { ?>
            <?php
            if ($this->session->userdata['role_id'] == 2) { ?>
                <li><a href="<?= base_url('home/'); ?>">Rumah</a></li>
                <li><a href="<?= base_url('home/tentang'); ?>">Tentang</a></li>
                <li><a href="<?= base_url('booking/'); ?>">Booking</a></li>
                <li><a href="<?= base_url('user/index'); ?>">Profil</a></li>
                <li><a href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
            <?php } elseif ($this->session->userdata['role_id'] == 3) { ?>
                <li><a href="<?= base_url('sewa'); ?>">Rumah</a></li>
                <li><a href="<?= base_url('home/tentang'); ?>">Tentang</a></li>
                <li><a href="<?= base_url('user/anggota'); ?>">Anggota</a></li>
                <li><a href="<?= base_url('pesan'); ?>">Data Pemesanan</a></li>
                <li><a href="<?= base_url('pesan/daftarBooking'); ?>">Data Booking</a></li>
                <li><a href="<?= base_url('user/index'); ?>">Profil</a></li>
                <li><a href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
            <?php } elseif ($this->session->userdata['role_id'] == 1) { ?>
                <li><a href="<?= base_url('sewa'); ?>">Rumah</a></li>
                <li><a href="<?= base_url('home/tentang'); ?>">Tentang</a></li>
                <li><a href="<?= base_url('user/anggota'); ?>">Anggota</a></li>
                <li><a href="<?= base_url('pesan'); ?>">Data Pemesanan</a></li>
                <li><a href="<?= base_url('pesan/daftarBooking'); ?>">Data Booking</a></li>
                <li><a href="<?= base_url('user/index'); ?>">Profil</a></li>
                <li><a href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
            <?php } ?>
        <?php } else { ?>
            <li><a href="<?= base_url('home'); ?>">Rumah</a></li>
            <li><a href="<?= base_url('home/tentang'); ?>">Tentang</a></li>
            <li><a id="myBtn">Daftar</a></li>
            <li><a href="<?= base_url('auth'); ?>">Log in</a></li>
        <?php } ?>
        <li><a>Selamat Datang <b><?= $user; ?></b></a></li>
    </ul>
</nav>
</header>
<div class="kotak_login">
    <h1>HUNIAN KONTRAK</h1>
    <p class="tulisan_login">Silakan Daftar</p>

    <?= $this->session->flashdata('pesan'); ?>
    <form method="POST" action="<?= base_url('auth/regisPemilik'); ?>">
        <label>Nama</label>
        <input type="text" name="nama" class="form_login" value="<?= set_value('nama'); ?>" id="nama" placeholder="nama ..">
        <?= form_error('nama'); ?>
        <label>Alamat</label>
        <input type="text" name="alamat" class="form_login" value="<?= set_value('alamat'); ?>" id="alamat" placeholder="alamat ..">
        <?= form_error('alamat'); ?>
        <label>No Telepon</label>
        <input type="text" name="no_telp" class="form_login" value="<?= set_value('no_telp'); ?>" id="no_telp" placeholder="no_telp ..">
        <?= form_error('no_telp'); ?>
        <label>Email</label>
        <input type="text" name="email" class="form_login" value="<?= set_value('email'); ?>" id="email" placeholder="email ..">
        <?= form_error('email'); ?>
        <label>No Rekening</label>
        <input type="text" name="rek" class="form_login" value="<?= set_value('rek'); ?>" id="rek" placeholder="rek ..">
        <?= form_error('rek'); ?>
        <label>Password</label>
        <input type="password" name="password1" class="form_login" id="password1" placeholder="password ..">
        <?= form_error('password1'); ?>
        <label>Ulangi Password</label>
        <input type="password" name="password2" class="form_login" id="password2" placeholder="password ..">


        <button type="submit" class="tombol_login">Daftar</button>
        <p>
            Sudah mempunyai akun?
            <a href="<?= base_url('auth'); ?>" class="tombol_daftar">Login
        </p>

    </form>
</div>
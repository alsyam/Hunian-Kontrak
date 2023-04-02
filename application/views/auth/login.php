<div class="kotak_login">
    <h1>HUNIAN KONTRAK</h1>
    <p class="tulisan_login">Silakan login</p>

    <?= $this->session->flashdata('pesan'); ?>
    <form method="POST" action="<?= base_url('auth'); ?>">
        <label>Email</label>
        <input type="text" name="email" class="form_login" value="<?= set_value('email'); ?>" id="email" placeholder="Email ..">
        <?= form_error('email'); ?>
        <label>Password</label>
        <input type="password" name="password" class="form_login" id="password" placeholder="Password ..">
        <?= form_error('password'); ?>
        <button type="submit" class="tombol_login">Masuk</button>
        <p>
            Ingin melihat rumah?
            <a href="<?= base_url('home'); ?>" class="tombol_daftar">Klik disini</a>
        </p>

    </form>
</div>
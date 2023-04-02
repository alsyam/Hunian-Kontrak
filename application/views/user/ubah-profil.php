<?= form_open_multipart('user/ubahProfil');
$user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); ?>
<div class="center">
    <label>Email</label>
    <input value="<?= set_value('email', $user['email']); ?>" type="text" class="form-login" id="email" name="email" placeholder="Masukkan email" readonly>
    <?= form_error('email'); ?>
    <label>Nama</label>
    <input value="<?= set_value('nama', $user['nama']); ?>" type="text" class="form-login" id="nama" name="nama" placeholder="Masukkan nama">
    <?= form_error('nama'); ?>
    <label>Alamat</label>
    <input value="<?= set_value('alamat', $user['alamat']); ?>" type="text" class="form-login" id="alamat" name="alamat" placeholder="Masukkan alamat">
    <?= form_error('alamat'); ?>
    <label>No Telepon</label>
    <input value="<?= set_value('no_telp', $user['no_telp']); ?>" type="text" class="form-login" id="no_telp" name="no_telp" placeholder="Masukkan no telepon">
    <?= form_error('no_telp'); ?>
    <br>
    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" width="200" height="220" alt="...">
    <input value="<?= set_value('image', $user['image']); ?>" type="file" class="form-login" id="image" name="image">
    <button type="submit" class="button">Edit</button>
</div>
<?= form_close() ?>
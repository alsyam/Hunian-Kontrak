<?= form_open_multipart(); ?>
<div class="center">
    <label>Luas Tanah</label>
    <input value="<?= set_value('luas_t', $sewa['luas_t']); ?>" type="text" class="form-login" id="luas_t" name="luas_t" placeholder="Masukkan nama luas_t">
    <?= form_error('luas_t'); ?>
    <label>Luas Bangunan</label>
    <input value="<?= set_value('luas_b', $sewa['luas_b']); ?>" type="text" class="form-login" id="luas_b" name="luas_b" placeholder="Masukkan nama luas_b">
    <?= form_error('luas_b'); ?>
    <label>Listrik</label>
    <input value="<?= set_value('listrik', $sewa['listrik']); ?>" type="text" class="form-login" id="listrik" name="listrik" placeholder="Masukkan nama listrik">
    <?= form_error('listrik'); ?>
    <label>No Telepon</label>
    <input value="<?= set_value('no_telp', $sewa['no_telp']); ?>" type="text" class="form-login" id="no_telp" name="no_telp" placeholder="Masukkan nama no telepon">
    <?= form_error('no_telp'); ?>

    <label>Alamat</label>
    <input value="<?= set_value('alamat', $sewa['alamat']); ?>" type="text" class="form-login" id="alamat" name="alamat" placeholder="Masukkan Alamat sewa">
    <?= form_error('alamat'); ?>

    <label>deskripsi</label>
    <input value="<?= set_value('deskripsi', $sewa['deskripsi']); ?>" type="text" class="form-login" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi">
    <?= form_error('deskripsi'); ?>

    <label>Harga</label>
    <input value="<?= set_value('harga', $sewa['harga']); ?>" type="text" class="form-login" id="harga" name="harga" placeholder="Masukkan harga">
    <?= form_error('harga'); ?>

    <label>Masa Penyewaan</label>
    <select class="form-login" id="durasi" name="durasi" required>
        <option>Silahkan Pilih Lama Waktu Penyewaan Rumah</option>
        <option value="30">Sebulan</option>
        <option value="365">Setahun</option>
    </select>

    <label>Stok</label>
    <input value="<?= set_value('stok', $sewa['stok']); ?>" type="text" class="form-login" id="stok" name="stok" placeholder="Masukkan stok">
    <?= form_error('stok'); ?>

    <label>Gambar 1</label>
    <br>
    <img src="<?= base_url('assets/img/upload/') . $sewa['image'] ?>" width="200" height="120" alt="...">
    <input value="<?= set_value('image', $sewa['image']); ?>" type="file" class="form-login" id="image" name="image">
    <label>Gambar 2</label>
    <br>
    <img src="<?= base_url('assets/img/upload/') . $sewa['image2'] ?>" width="200" height="120" alt="...">
    <input value="<?= set_value('image2', $sewa['image2']); ?>" type="file" class="form-login" id="image2" name="image2">
    <label>Gambar 3</label>
    <br>
    <img src="<?= base_url('assets/img/upload/') . $sewa['image3'] ?>" width="200" height="120" alt="...">
    <input value="<?= set_value('image3', $sewa['image3']); ?>" type="file" class="form-login" id="image3" name="image3">


    <button type="submit" class="tombol_daftar">Confirm</button>
</div>
<?= form_close() ?>
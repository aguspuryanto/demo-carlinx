<?php
helper('form');
echo json_encode($userList);
?>
        
    <?= form_open('#', []); ?>
        <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" value="<?= $userList[0]['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan" value="<?= $userList[0]['nama_pt']; ?>">
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <!-- <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" value="<?= $userList[0]['stat']; ?>"> -->
            <select class="form-control" name="jabatan" id="jabatan">
                <option value="1" <?= $userList[0]['stat'] == 1 ? 'selected' : ''; ?>>CEO</option>
                <option value="2" <?= $userList[0]['stat'] == 2 ? 'selected' : ''; ?>>DIREKTUR</option>
                <option value="3" <?= $userList[0]['stat'] == 3 ? 'selected' : ''; ?>>MANAGER</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="noIjinUsaha" class="form-label">No. Ijin Usaha/SIUP</label>
            <input type="text" class="form-control" id="noIjinUsaha" placeholder="No. Ijin Usaha/SIUP" value="<?= $userList[0]['ijin_pt']; ?>">
        </div>
        <div class="mb-3">
            <label for="noRekening" class="form-label">No. Rekening</label>
            <input type="text" class="form-control" id="noRekening" placeholder ="No. Rekening" value="<?= $userList[0]['norek']; ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $userList[0]['alamat']; ?>">
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" placeholder="Kota" value="<?= $userList[0]['kota']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" value="<?= $userList[0]['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="noTelepon" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="noTelepon" placeholder="No. Telepon" value="<?= $userList[0]['hp_perush']; ?>">
        </div>
        <div class="mb-3">
            <label for="noCS" class="form-label">No. Customer Service</label>
            <input type="text" class="form-control" id="noCS" placeholder="No. Customer Service" value="<?= $userList[0]['hp_cs']; ?>">
        </div>
        <div class="mb-3">
            <label for="jenisLayanan" class="form-label">Jenis Layanan</label>
            <select class="form-select" id="jenisLayanan">
                <option selected>Pilih Layanan</option>
                <option value="pelayanan">Pelayanan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select class="form-select" id="tipe">
                <option selected>Pilih Tipe</option>
                <option value="bulanan">Bulanan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
            <input type="file" class="form-control" id="dokumenPendukung" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    <?php echo form_close(); ?>
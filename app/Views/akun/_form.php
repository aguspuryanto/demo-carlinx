<?php
helper('form');
echo json_encode($userList);

$attributes = [];
$hidden_input = ['usernm' => $userList[0]['username']];
?>
        
    <?= form_open('akun/update', $attributes, $hidden_input); ?>
        <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" name="nama" value="<?= $userList[0]['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan" name="nama_pt" value="<?= $userList[0]['nama_pt']; ?>">
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-control" name="jabatan" id="jabatan">
                <option value="0" <?= $userList[0]['jabatan'] == 0 ? 'selected' : ''; ?>>CEO</option>
                <option value="1" <?= $userList[0]['jabatan'] == 1 ? 'selected' : ''; ?>>DIREKTUR</option>
                <option value="2" <?= $userList[0]['jabatan'] == 2 ? 'selected' : ''; ?>>MANAGER</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="noIjinUsaha" class="form-label">No. Ijin Usaha/SIUP</label>
            <input type="text" class="form-control" id="noIjinUsaha" placeholder="No. Ijin Usaha/SIUP" name="ijin_pt" value="<?= $userList[0]['ijin_pt']; ?>">
        </div>
        <div class="mb-3">
            <label for="noRekening" class="form-label">No. Rekening</label>
            <input type="text" class="form-control" id="noRekening" placeholder ="No. Rekening" name="norek" value="<?= $userList[0]['norek']; ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="<?= $userList[0]['alamat']; ?>">
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <!-- <input type="text" class="form-control" id="kota" placeholder="Kota" name="kota" value="<?= $userList[0]['kota']; ?>"> -->
            <select class="form-control" name="kd_kota" id="kota">
                <option value="0" <?= $userList[0]['kota'] == 0 ? 'selected' : ''; ?>>Bandung</option>
                <?php foreach ($cityList as $kota) : ?>
                    <option value="<?= $kota['kode']; ?>" <?= $userList[0]['kd_kota'] == $kota['kode'] ? 'selected' : ''; ?>><?= $kota['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $userList[0]['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="noTelepon" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="noTelepon" placeholder="No. Telepon" name="hp_perush" value="<?= $userList[0]['hp_perush']; ?>">
        </div>
        <div class="mb-3">
            <label for="noCS" class="form-label">No. Customer Service</label>
            <input type="text" class="form-control" id="noCS" placeholder="No. Customer Service" name="hp_cs" value="<?= $userList[0]['hp_cs']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Jenis Layanan</label>
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="is_layanan" <?= $userList[0]['is_layanan'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="fuel">Pelayanan</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="is_bulanan" <?= $userList[0]['is_bulanan'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="fuel">Bulanan</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="is_lepaskunci" <?= $userList[0]['is_lepaskunci'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="fuel">Lepas Kunci</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="is_event" <?= $userList[0]['is_event'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="fuel">Event</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Dokumen Pendukung</label>
            <div class="row">
                <?php for($j=1; $j<=4; $j++) {
                    if($userList[0]['foto_' . $j] == null) {
                        $path_images = '<div class="container d-flex justify-content-center">
                            <div class="row d-flex align-items-center">
                            <button type="button" class="btn btn-primary btn-sm">Upload</button>
                            </div>
                        </div>';
                    } else {                        
                        $path_images = '<img class="mr-3 img-thumbnail" src="' . $_ENV['API_BASEURL'] . 'images_profile/' . $userList[0]['foto_' . $j] . '" alt="Generic placeholder image">';
                    }
                    
                    echo '<div class="col-sm-3">
                        <div class="card mb-3">
                            <div class="card-body p-0">
                                ' . $path_images . '
                            </div>
                        </div>
                    </div>';
                } ?>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="is_publish" <?= $userList[0]['is_publish'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="fuel">Publikasikan</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        
        <input type="hidden" name="kd_kota" value="<?= $userList[0]['kd_kota']; ?>">
    <?php echo form_close(); ?>
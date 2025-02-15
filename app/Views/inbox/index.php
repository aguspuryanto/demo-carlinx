<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <?php
                    //include_once '_form.php';
                    // echo json_encode($listData); die();
                    // echo json_encode($listUser); die();
                    // 1. Vendor : jika user.kd_rental == order.kd_rental
                    // 2. Pemesan : jika user.kd_rental != order.kd_rental
                    // In = Pemesan, Out = Vendor
                    $is_vendor = false;
                    $is_pemesan = false;
                    
                    if (!empty($listData['result_list_order'])) {
                        $is_vendor = ($listData['result_list_order'][0]['kode_rental'] == $listUser['kd_rental']);
                        $is_pemesan = ($listData['result_list_order'][0]['kode_rental'] != $listUser['kd_rental']);
                    }
                    echo 'is_vendor : ' . $is_vendor . '; is_pemesan : ' . $is_pemesan . '<br>';
                    ?>
                    <ul class="list-group">
                    <?php if (empty($listData['result_list_order'])) : ?>
                        <li class="list-group-item">Data kosong</li>
                    <?php else : ?>
                        <?php foreach ($listData['result_list_order'] as $item) : ?>
                            <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id_order'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <!-- <div class="mb-2"><span class="badge <?=($item['grp_penyewa']=='1') ? 'bg-danger' : 'bg-info';?>"><?= $listGroup[$item['grp_penyewa']] ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= $listStatus[$item['stat']]; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right"><?=$item['liq'] == '2' ? 'cs: ' . $item['nama_cs'] : 'cs: ' . $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span class="badge <?=$item['liq'] == '2' ? 'bg-warning text-warning' : 'bg-success text-success'?>">*</span> <?=$item['grp_penyewa'] == '2' ? 'pemesan' : 'vendor'; ?>: <?= $item['grp_penyewa'] == '2' ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small> -->
                                <div class="mb-2"><span class="badge <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'bg-info' : 'bg-danger';?>"><?= ($item['kode_rental'] == $listUser['kd_rental']) ? 'In' : 'Out' ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= $listStatus[$item['stat']]; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right">cs: <?=$item['liq'] == '2' ? $item['nama_cs'] : $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span class="badge <?=$item['liq_tujuan'] == '2' ? 'bg-warning text-warning' : 'bg-success text-success'?>">*</span> <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'Pemesan' : 'Vendor'; ?>: <?= ($item['kode_rental'] == $listUser['kd_rental']) ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small>
                            </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_order.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        let is_vendor = '<?= $is_vendor ?>';
        let is_pemesan = '<?= $is_pemesan ?>';

        $('#addModal').on('show.bs.modal', function (e) {
            // Accessing the target element that triggered the modal
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                // Accessing data-id and data-item
                let idOrder = triggerElement.dataset.id;
                let itemData = JSON.parse(triggerElement.dataset.item); // Decoding JSON

                var textNote = '';
                if(itemData.stat == '1'){
                    textNote = 'Menunggu respon dari rental';
                } else if(itemData.stat == '2'){
                    textNote = 'Pastikan data order sudah benar';
                }

                textNote = 'Pastikan Unit Tersedia sebelum menerima order';

                var html = '<div class="table-responsive mb-0">';
                html += '<table class="table table-bordered">';
                html += '<tbody>';
                html += '<tr><th width="150">Tgl.Mulai</th><td>' + itemData.tgl_start + '</td></tr>';
                html += '<tr><th>Tgl.Selesai</th><td>' + itemData.tgl_finish + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><th>Jumlah Bulan</th><td>' + (itemData.jml_bln) + '</td></tr>';
                } else {
                    html += '<tr><th>Tujuan</th><td>' + itemData.jemput.substr(itemData.jemput.lastIndexOf(",") + 1) + ' - ' + itemData.tujuan.substr(itemData.tujuan.lastIndexOf(",") + 1) + '</td></tr>';
                }
                html += '<tr><th>Unit</th><td>' + itemData.nama_unit + '</td></tr>';
                html += '<tr><th>Tahun</th><td>' + itemData.tahun + '</td></tr>';
                html += '<tr><th>BBM</th><td>' + itemData.bbm + '</td></tr>';
                html += '<tr><th>Transmisi</th><td>' + (itemData.transmisi) + '</td></tr>';
                html += '<tr><th>Warna</th><td>' + (itemData.warna) + '</td></tr>';
                html += '<tr><th>Jml.Order</th><td>' + (itemData.jml_order) + '</td></tr>';
                html += '<tr><th>Include</th><td>' + (itemData.ketr !='' ? itemData.ketr : 'Mobil, Driver') + '</td></tr>';
                html += '<tr><th>Biaya</th><td>Rp. ' + numberFormat(itemData.hrg_sewa) + '</td></tr>';
                html += '<tr><th>Pembayaran</th><td>' + (itemData.jns_byr == '1' ? 'Lunas' : 'Mundur') + '</td></tr>';
                html += '<tr><th>Catatan</th><td>' + (itemData.catatan_byr ?? '-') + '</td></tr>';
                html += '<tr><th>Voucher</th><td>' + (itemData.voucher ?? '-') + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><th>Penanggung Jawab</th><td>' + (itemData.tg_jwb == '1' ? 'Rental Pemesan' : 'Pelanggan') + '</td></tr>';
                }
                html += '</tbody>';
                html += '</table>';
                html += '</div>';
                html += '<div class="mb-3"><p class="h6">* ' + textNote + '</p></div>';

                // append form hidden
                const newForm = document.createElement('form'); // Create a new form
                newForm.method = 'POST';
                newForm.id = 'formConfirmOrder';
                newForm.action = '#';
                
                newForm.innerHTML = '<div class="mb-3 align-items-center"><input type="hidden" name="id_order" class="form-control" id="id_order" value="' + idOrder + '"></div>'; // Add the hidden input with value
                newForm.innerHTML += '<div class="mb-3 align-items-center"><input type="hidden" name="stat_ori" class="form-control" id="stat_ori" value="' + itemData.stat + '"></div>'; // Add the hidden input with value

                // load
                let resultPlgn = [];
                $.get('<?= base_url('order/detail-order') ?>/' + idOrder, function(data) {
                    let jsonData = JSON.parse(data);
                    resultPlgn = jsonData.result_plgn[0];
                    console.log(resultPlgn, 'resultPlgn');

                    let is_readonly = (is_vendor == '1') ? 'readonly' : '';

                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">Pelanggan</label><input type="text" name="nama_plgn" class="form-control" id="nama_plgn" value="' + (resultPlgn.nama_plgn || '') + '" ' + is_readonly + ' required></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">No HP</label><input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="No HP" value="' + (resultPlgn.no || '') + '" ' + is_readonly + '></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">No KTP</label><input type="text" name="ktp_plgn" class="form-control" id="ktp_plgn" placeholder="No KTP" value="' + (resultPlgn.ktp_plgn || '') + '" ' + is_readonly + '></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">Note</label><input type="text" name="note" class="form-control" id="note" placeholder="Note" value="' + (resultPlgn.note || '') + '" ' + is_readonly + '></div>'; // Add input with value

                    if(is_vendor == '1'){
                        // form driver
                        newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">Driver</label><input type="text" name="nama_driver" class="form-control" id="nama_driver" placeholder="Nama Driver" required></div>'; // Add input with value
                        newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">No HP</label><input type="text" name="no_hp_driver" class="form-control" id="no_hp_driver" placeholder="No HP"></div>'; // Add input with value
                        newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">Nopol</label><input type="text" name="nopol_driver" class="form-control" id="nopol_driver" placeholder="Nopol" required></div>'; // Add input with value
                        newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label visually-hidden">Note</label><input type="text" name="note_driver" class="form-control" id="note_driver" placeholder="Note"></div>'; // Add input with value

                        newForm.innerHTML += `<div class="mb-3 align-items-center">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100 btnConfirmOrder" data-stat="6">Tolak</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-secondary w-100 btnConfirmOrder" data-stat="4">Terima</button>
                                </div>
                            </div>
                        </div>`; // Changed button text
                    } else {
                        newForm.innerHTML += `<div class="mb-3 align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 btnConfirmOrder" data-stat="6">Batal</button>
                                </div>
                            </div>
                        </div>`; // Changed button text
                    }
                });
                
                $('#addModal .modal-body').html(html).append(newForm);
                $('#addModal').modal('show');
            } else {
                console.warn("Modal triggered without related target!");
            }
        });

        $(document).on('click', 'button.btnConfirmOrder', function(e) {
            e.preventDefault();
            let stat = $(this).data('stat');
            console.log(stat, 'stat');
            
            let form = $('#formConfirmOrder');
            form.addClass('was-validated'); // Add Bootstrap validation class
            
            // Reset previous error states
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');
      
            // Define base validation rules
            const baseValidationRules = [
                { field: 'id_order', message: 'Order data is missing' },
                { field: 'stat_ori', message: 'Order data is missing' },
                { field: 'nama_plgn', message: 'Customer name is required' }
            ];

            if (is_vendor == '1') {
                baseValidationRules.push({ field: 'nama_driver', message: 'Driver name is required' });
                baseValidationRules.push({ field: 'nopol_driver', message: 'Vehicle plate number is required' });
            }

            // Validate all fields
            let isValid = true;
            let errors = [];

            if(stat == '6'){
                let form = $('#formConfirmOrder');
                // find #note, then add input alasan_batal
                let notedriver = form.find('#note_driver');
                notedriver.after('<div class="mt-3 mb-3 align-items-center"><label class="form-label">Alasan Tolak</label><textarea name="alasan_batal" class="form-control" id="alasan_batal" placeholder="Keterangan" required></textarea></div>');

                // Clear previous validation rules and set new ones for cancellation
                validationRules = [
                    { field: 'id_order', message: 'Order data is missing' },
                    { field: 'stat_ori', message: 'Order data is missing' },
                    { field: 'alasan_batal', message: 'Reason for rejection is required' }
                ];
            }
      
            let validationRules = [...baseValidationRules]; // Copy base rules

            // Validate each field
            for (const rule of validationRules) {
                const $field = $(`#${rule.field}`);

                // Pastikan elemen ditemukan sebelum membaca nilainya
                if ($field.length === 0) {
                    console.warn(`Elemen dengan ID '${rule.field}' tidak ditemukan.`);
                    continue; // Lewati iterasi jika elemen tidak ada
                }

                const $parent = $field.parent(); // Pastikan ini sesuai dengan struktur HTML Anda
                const fieldValue = $field.val()?.trim() || ''; // Cegah error undefined

                if (fieldValue === '') {
                    // Hapus pesan error lama jika sudah ada
                    $parent.find('.invalid-feedback').remove();

                    // Tambahkan pesan error
                    $parent.append(`<div class="invalid-feedback">${rule.message}</div>`);

                    // Tambahkan class untuk menandai error
                    $field.addClass('is-invalid');

                    isValid = false;
                } else {
                    // Hapus error jika input sudah benar
                    $field.removeClass('is-invalid');
                    $parent.find('.invalid-feedback').remove();
                }
            }

            if (!isValid) {
                return false;
            }

            let formData = new FormData(form[0]);

            // If validation passes, continue with form submission
            $.ajax({
                url: '<?= base_url('inbox/confirm') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    let data = JSON.parse(response);
                    if (data.success) {
                        // Show success message with Bootstrap toast or alert
                        const successAlert = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Order confirmed successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                        form.before(successAlert);
                        
                        setTimeout(() => {
                            $('#addModal').modal('hide');
                            location.reload();
                        }, 1500);
                    } else {
                        // Show error message
                        const errorAlert = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data.message || 'Failed to confirm order'}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                        form.before(errorAlert);
                    }
                },
                error: function(xhr, status, error) {
                    // Show error message
                    const errorAlert = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        An error occurred: ${error}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    form.before(errorAlert);
                }
            });
        });

    });

    async function loadDetailOrder(idOrder) {
        try {
            let response = await fetch('<?= base_url('order/detail-order') ?>/' + idOrder);
            let data = await response.json(); // Parse JSON langsung
            console.log(data.result_plgn);
            return data.result_plgn; // Mengembalikan data jika diperlukan
        } catch (error) {
            console.error('Gagal mengambil data:', error);
        }
    }

    // Helper function for number formatting
    function numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
<?= $this->endSection() ?>
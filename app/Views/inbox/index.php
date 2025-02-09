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
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group">
                    <?php if (empty($listData['result_list_order'])) : ?>
                        <li class="list-group-item">Data kosong</li>
                    <?php else : ?>
                        <?php foreach ($listData['result_list_order'] as $item) : ?>
                            <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id_order'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <div class="mb-2"><span class="badge <?=($item['grp_penyewa']=='1') ? 'bg-danger' : 'bg-info';?>"><?= $listGroup[$item['grp_penyewa']] ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= $listStatus[$item['stat']]; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right">cs: <?=$item['liq'] == '2' ? $item['nama_cs'] : $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span class="badge <?=$item['liq'] == '2' ? 'bg-warning text-warning' : 'bg-success text-success'?>">*</span> <?=$item['grp_penyewa'] == '2' ? 'pemesan' : 'vendor'; ?>: <?= $item['grp_penyewa'] == '2' ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small>
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
        $('#addModal').on('show.bs.modal', function (e) {
            // Accessing the target element that triggered the modal
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                // Accessing data-id and data-item
                let idOrder = triggerElement.dataset.id;
                let itemData = JSON.parse(triggerElement.dataset.item); // Decoding JSON

                console.log('ID Order:', idOrder);
                console.log('Item Data:', itemData);

                // Panggil fungsi
                // let resultPlgn = [];
                // loadDetailOrder(idOrder).then(resp => {
                //     console.log('Data pelanggan:', resp);
                // });

                var textNote = '';
                if(itemData.stat == '1'){
                    textNote = 'Menunggu respon dari rental';
                } else if(itemData.stat == '2'){
                    textNote = 'Pastikan data order sudah benar';
                }

                var html = '<div class="table-responsive mb-0">';
                html += '<table class="table table-bordered">';
                html += '<tbody>';
                html += '<tr><th width="150">Tgl.Mulai</th><td>' + itemData.tgl_start + '</td></tr>';
                html += '<tr><th>Tgl.Selesai</th><td>' + itemData.tgl_finish + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><th>Jumlah Bulan</th><td>' + (itemData.jml_bln) + '</td></tr>';
                } else {
                    html += '<tr><th>Tujuan</th><td>' + itemData.lokasi_tujuan + '</td></tr>';
                }
                html += '<tr><th>Unit</th><td>' + itemData.nama_unit + '</td></tr>';
                html += '<tr><th>Tahun</th><td>' + itemData.tahun + '</td></tr>';
                html += '<tr><th>BBM</th><td>' + itemData.bbm + '</td></tr>';
                html += '<tr><th>Transmisi</th><td>' + (itemData.transmisi) + '</td></tr>';
                html += '<tr><th>Warna</th><td>' + (itemData.warna) + '</td></tr>';
                html += '<tr><th>Jml.Order</th><td>' + (itemData.jml_order) + '</td></tr>';
                html += '<tr><th>Include</th><td>' + (itemData.ketr ?? '-') + '</td></tr>';
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

                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">Pelanggan</label><input type="text" name="nama_plgn" class="form-control" id="nama_plgn" value="' + (resultPlgn.nama_plgn || '') + '"></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">No HP</label><input type="text" name="no_hp" class="form-control" id="no_hp" value="' + (resultPlgn.no || '') + '"></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">No KTP</label><input type="text" name="ktp_plgn" class="form-control" id="ktp_plgn" value="' + (resultPlgn.ktp_plgn || '') + '"></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><label class="form-label">Note</label><input type="text" name="note" class="form-control" id="note" value="' + (resultPlgn.note || '') + '"></div>'; // Add input with value
                    newForm.innerHTML += '<div class="mb-3 align-items-center"><button type="submit" class="btn btn-primary w-100 btnConfirmOrder">Batal</button></div>'; // Changed button text
                });
                
                $('#addModal .modal-body').html(html).append(newForm);
                $('#addModal').modal('show');
            } else {
                console.warn("Modal triggered without related target!");
            }
        });

        $(document).on('click', 'button.btnConfirmOrder', function(e) {
            e.preventDefault();
            
            let form = $('#formConfirmOrder');
            let formData = new FormData(form[0]);

            // Get values and validate
            let id_order = $('#id_order').val();
            let stat_ori = $('#stat_ori').val();
            let nama_penyewa = $('#nama_penyewa').val();
            
            if (!id_order || !nama_penyewa) {
                alert('Please fill in all required fields');
                return false;
            }

            formData.append('id_order', id_order);
            formData.append('stat_ori', stat_ori);
            formData.append('nama_penyewa', nama_penyewa);

            // Send AJAX request
            $.ajax({
                url: '<?= base_url('inbox/confirm') ?>', // Update this to your actual endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert('Order confirmed successfully!');
                        $('#addModal').modal('hide');
                        // Optionally reload the page or update the UI
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to confirm order');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
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
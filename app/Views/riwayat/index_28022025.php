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
                    // echo json_encode($listUser); die();
                    // 1. Vendor : jika user.kd_rental == order.kd_rental
                    // 2. Pemesan : jika user.kd_rental != order.kd_rental
                    // In = Pemesan, Out = Vendor
                    $is_vendor = false;
                    $is_pemesan = false;
                    
                    if (!empty($listData['result_list_order'])) {
                        $is_vendor = ($listData['result_list_order'][0]['kode_rental'] == $listUser['kd_rental']);
                        $is_pemesan = ($listData['result_list_order'][0]['kode_rental'] != $listUser['kd_rental']);
                    }
                    // echo 'is_vendor : ' . $is_vendor . '; is_pemesan : ' . $is_pemesan . '<br>';
                    ?>
                    <ul class="list-group">
                    <?php if (empty($listData['result_list_order'])) : ?>
                        <li class="list-group-item">Data kosong</li>
                    <?php else : ?>
                        <?php foreach ($listData['result_list_order'] as $item) : ?>
                            <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id_order'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <!-- <div class="mb-2"><span class="badge <?=($item['liq_tujuan']=='1') ? 'bg-danger' : 'bg-info';?>"><?= $listGroup[$item['liq_tujuan']] ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= $listStatus[$item['stat']]; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right"><?=$item['liq'] == '2' ? 'cs: ' . $item['nama_cs'] : 'cs: ' . $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span class="badge <?=$item['liq_tujuan'] == '2' ? 'bg-warning text-warning' : 'bg-success text-success'?>">*</span> <?=$item['liq_tujuan'] == '1' ? 'pemesan' : 'vendor'; ?>: <?= $item['liq_tujuan'] == '1' ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small> -->

                                <div class="mb-2"><span class="badge <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'bg-info' : 'bg-danger';?>"><?= ($item['kode_rental'] == $listUser['kd_rental']) ? 'In' : 'Out' ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y H:i:s', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat'] == '9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= $listStatus[$item['stat']]; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="text-muted text-right">cs: <?=($item['kode_rental'] == $listUser['kd_rental']) ? $item['nama_cs'] : $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span class="badge <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'bg-success text-success' : 'bg-warning text-warning'?>">*</span> <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'Pemesan' : 'Vendor'; ?>: <?= ($item['kode_rental'] == $listUser['kd_rental']) ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small>
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
        const baseUrlImg = "<?= base_url('proxy.php?url=' . $_ENV['API_BASEURL'] . 'images/') ?>";
        $('#addModal').on('show.bs.modal', function (e) {
            // Accessing the target element that triggered the modal
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                // Accessing data-id and data-item
                let idOrder = triggerElement.dataset.id;
                let itemData = JSON.parse(triggerElement.dataset.item); // Decoding JSON

                console.log('ID Order:', idOrder);
                console.log('Item Data:', itemData);

                var html = '<div class="table-responsive mb-3">';
                // tgl order, jika stat=9 selesai
                if(itemData.stat=='9') {
                    html += '<div class="mb-3"><p class="h6 lead p-2">Tgl Order</p><div class="d-flex justify-content-between"><span>' + itemData.tgl_order + '</span><span><a href="#">Lihat bukti pesanan</a></span></div></div>';
                }

                html += '<p class="h6 lead p-2">Pesanan</p><table class="table table-sm table-borderless">';
                html += '<tbody>';
                html += '<tr><td width="150">Tgl.Mulai</td><td>' + itemData.tgl_start + '</td></tr>';
                html += '<tr><td>Tgl.Selesai</td><td>' + itemData.tgl_finish + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><td>Jumlah Bulan</td><td>' + (itemData.jml_bln) + '</td></tr>';
                } else {
                    html += '<tr><td>Tujuan</td><td>' + itemData.tujuan + '</td></tr>';
                }
                html += '<tr><td>Unit</td><td>' + itemData.nama_unit + '</td></tr>';
                html += '<tr><td>Tahun</td><td>' + itemData.tahun + '</td></tr>';
                html += '<tr><td>BBM</td><td>' + itemData.bbm + '</td></tr>';
                html += '<tr><td>Transmisi</td><td>' + itemData.transmisi + '</td></tr>';
                html += '<tr><td>Warna</td><td>' + itemData.warna + '</td></tr>';
                html += '<tr><td>Jml.Order</td><td>' + itemData.jml_order + '</td></tr>';
                html += '<tr><td>Include</td><td>' + (itemData.ketr !='' ? itemData.ketr : 'Mobil, Driver') + '</td></tr>';
                html += '<tr><td>Biaya</td><td>Rp. ' + numberFormat(itemData.hrg_sewa) + '</td></tr>';
                html += '<tr><td>Pembayaran</td><td>' + (itemData.jns_byr == '1' ? 'Lunas' : 'Mundur') + '</td></tr>';
                html += '<tr><td>Catatan</td><td>' + (itemData.catatan_byr ?? '-') + '</td></tr>';
                html += '<tr><td>Voucher</td><td>' + (itemData.voucher ?? '-') + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><td>Penanggung Jawab</td><td>' + (itemData.tg_jwb == '1' ? 'Rental Pemesan' : 'Pelanggan') + '</td></tr>';
                }

                if(itemData.stat=='9') {
                    html += '<tr><td>Penangung Jawab</td><td>' + (itemData.tg_jwb == '1' ? 'Pemilik' : 'Penyewa') + '</td></tr>';
                }

                html += '</tbody>';
                html += '</table>';
                html += '</div>';

                if(itemData.stat=='9') {
                    // Pelanggan
                    html += '<div class="mb-3"><p class="h6 lead">Pelanggan</p><span></span></div>';

                    // Unit
                    html += '<div class="mb-3"><p class="h6 lead">Unit</p><span></span></div>';

                    // pembayaran
                    html += '<div class="mb-3"><p class="h6 lead">Pembayaran</p><table class="table table-borderless">';
                    html += '<tbody>';
                    html += '<tr><td>Sub Total</td><td>Rp. ' + numberFormat(itemData.hrg_sewa) + '</td></tr>';
                    html += '<tr><td>Discount</td><td>Rp. ' + numberFormat(itemData.nominal_disc) + '</td></tr>';
                    html += '<tr><td>Uang Muka</td><td>Rp. ' + numberFormat(itemData.nominal_dp) + '</td></tr>';
                    html += '<tr><td>Total Tagihan</td><td>Rp. ' + numberFormat(itemData.hrg_sewa_total) + '</td></tr>';
                    html += '<tr><td>Metode Bayar</td><td>' + (itemData.metode_bayar == '1' ? 'Tunai' : 'Mundur') + '</td></tr>';
                    html += '<tr><td>Jatuh Tempo</td><td>' + (itemData.tgl_tempo ?? '-') + '</td></tr>';
                    html += '<tr><td colspan="2">*Keterangan:</td></tr>';
                    html += '<tr><td colspan="2">' + (itemData.ket_bayar ?? '-') + '</td></tr>';
                    html += '<tr><td colspan="2">Bank Tujuan Transfer</td></tr>';
                    html += '<tr><td colspan="2">' + (itemData.norek_rental ?? '-') + '</td></tr>';
                    html += '</tbody>';
                    html += '</table></div>';

                    // Dokumen Serah terima
                    html += '<div class="mb-3"><p class="h6 lead">Dokumen Serah Terima</p>';
                    html += '<div class="row"><div class="col"><img src="' + baseUrlImg + itemData.foto_serah + '" alt="Foto Serah Terima"></div><div class="col"><img src="' + baseUrlImg + itemData.foto_terima + '" alt="Foto Terima"></div></div>';
                    html += '</div>';
                    html += '<div class="mb-3"><input type="checkbox" id="setuju" checked> Pihak Rental telah menyetuji dan menerima pengembalian Unit</div>';
                } else {
                    html += `<div class="mb-3">
                        <p class="h6 lead">Alasan Pembatalan</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea" cols="30" rows="2" readonly>` + (itemData.alasan_batal ?? `-`) + `</textarea>
                            <label for="floatingTextarea">Keterangan</label>
                        </div>
                    </div>`;
                }

                // append form hidden
                // const newForm = document.createElement('form'); // Create a new form
                // newForm.method = 'POST';
                // newForm.action = '';
                
                // newForm.innerHTML = '<div class="mb-3 align-items-center"><label class="form-label">Pelanggan</label><input type="text" name="pelanggan" class="form-control" id="pelanggan"></div>'; // Add the hidden input
                // newForm.innerHTML += '<div class="mb-3 align-items-center"><button type="submit" class="btn btn-primary w-100 btnConfirmOrder">Submit</button></div>'; // Add the hidden input
                
                $('#addModal .modal-body').html(html); //.append(newForm);
                $('#addModal').modal('show');
            } else {
                console.warn("Modal triggered without related target!");
            }
        });

    });

    // Helper function for number formatting
    function numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
<?= $this->endSection() ?>
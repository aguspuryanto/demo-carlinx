<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <?php  $file = __DIR__ . '/../_alert.php'; include($file); ?>

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
                    // echo 'is_vendor : ' . $is_vendor . '; is_pemesan : ' . $is_pemesan . '<br>';
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
                                <div class="mb-2"><span class="badge <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'bg-info' : 'bg-danger';?>"><?= ($item['kode_rental'] == $listUser['kd_rental']) ? 'In' : 'Out' ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small> <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> pull-right"><?= isset($listStatus[$item['stat']]) ? $listStatus[$item['stat']] : '-'; ?></small></div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                    <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right">cs: <?=$item['liq'] == '2' ? $item['nama_cs'] : $item['nama_member'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small><span style="font-size: 40%; transform:translateY(-40%);" class="badge <?=(($item['kode_rental'] == $listUser['kd_rental'])? $item['liq'] : $item['liq_tujuan']) == '3' ? 'bg-danger text-danger rounded-circle' : ((($item['kode_rental'] == $listUser['kd_rental'])? $item['liq'] : $item['liq_tujuan']) == '2' ? 'bg-warning text-warning rounded-circle' : 'bg-success text-success rounded-circle')?>">*</span> <?=($item['kode_rental'] == $listUser['kd_rental']) ? 'Pemesan' : 'Vendor'; ?>: <?= ($item['kode_rental'] == $listUser['kd_rental']) ? $item['rental_penyewa'] : $item['rental_tujuan'] ?></small>
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
    <?php //include_once '_modal_payment.php'; ?>
    <?php include_once '_modal_img.php'; ?>
    <?php //include_once '_modal_driver.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let is_vendor = '<?= $is_vendor ?>';
        let is_pemesan = '<?= $is_pemesan ?>';
        let kd_rental = '<?= $listUser['kd_rental'] ?>';
        let payment_type = {
            1: 'Lunas',      // Full payment
            2: 'Uang Muka', // Down payment
            3: 'Mundur'    // Deferred payment
        };
        // payment_type[1]

        // Cek apakah modal harus dibuka setelah reload
        if (localStorage.getItem("openModal") === "true") {
            // $("#addModal").modal("show"); // Buka modal
            localStorage.removeItem("openModal"); // Hapus setelah dibuka
        }

        $('input[name=jns_byr]').on('change', function() {
            let val = $(this).val();
            if(val == '3'){
                $('.nominal_byr').removeClass('d-none');
            } else {
                $('.nominal_byr').addClass('d-none');
            }
        });

        $('#addModal').on('show.bs.modal', function (e) {
            // Accessing the target element that triggered the modal
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                // Accessing data-id and data-item
                let idOrder = triggerElement.dataset.id;
                let itemData = JSON.parse(triggerElement.dataset.item); // Decoding JSON
                console.log(itemData, 'itemData');

                if(itemData.kode_rental == kd_rental){
                    is_vendor = '1';
                    is_pemesan = '0';
                } else {
                    is_vendor = '0';
                    is_pemesan = '1';
                }
                console.log(is_vendor, 'is_vendor');
                console.log(is_pemesan, 'is_pemesan');
                
                var textNote = '';
                if(is_pemesan == '1'){
                    textNote = 'Menunggu respon dari rental';
                    if(itemData.stat == '4'){
                        textNote = 'Segera lakukan pembayaran ke Rental (atau sesuai kesepakatan)';
                    }
                } 
                if(is_vendor == '1'){
                    // textNote = 'Pastikan data order sudah benar';
                    textNote = 'Menunggu respon dari pemesan';
                    if(itemData.stat == '1'){
                        textNote = 'Pastikan Unit Tersedia sebelum menerima order';
                    }
                    if(itemData.stat == '5'){
                        textNote = 'Pembatalan hanya jika sudah konfirmasi ke Pemesan';
                    }
                }

                let listInclude = 'Mobil, Driver';

                if(itemData.is_bbm == '1') listInclude += ', BBM';
                if(itemData.is_makan == '1') listInclude += ', Makan Driver';
                if(itemData.is_hotel == '1') listInclude += ', Hotel';

                console.log(itemData.jns_order, '_jns_order');
                if(itemData.jns_order == '2'){
                    listInclude = 'Mobil Lepas Kunci';
                } else if(itemData.jns_order == '4') {
                    listInclude = 'Mobil Bulanan';
                }

                // text Pembayaran
                if(itemData.jns_byr == '3'){
                    textPayment = payment_type[itemData.jns_byr] + ' ' + itemData.tempo_bayar + ' hari';
                } else {
                    textPayment = payment_type[itemData.jns_byr];
                }

                // Create the detail HTML
                var html = '<div class="table-responsive mb-0">';
                // tgl order, jika stat=9 selesai
                if(itemData.stat=='9') {
                    html += '<div class="mb-3"><p class="h6 lead p-2">Tgl Order</p><div class="d-flex justify-content-between px-2"><span>' + itemData.tgl_order + '</span><span><a href="#">Lihat bukti pesanan</a></span></div></div>';
                }

                html += '<p class="h6 lead p-2">Pesanan</p><table class="table table-sm table-bordered">';
                html += '<tbody>';
                html += '<tr><th width="150">Tgl.Mulai</th><td>' + itemData.tgl_start + '</td></tr>';
                html += '<tr><th>Tgl.Selesai</th><td>' + itemData.tgl_finish + '</td></tr>';
                if(itemData.jns_order == '4'){
                    html += '<tr><th>Jumlah Bulan</th><td>' + (itemData.jml_bln) + '</td></tr>';
                } else if(itemData.jns_order == '2'){
                    // html += '<tr><th>Jumlah Bulan</th><td>' + (item.jml_bln) + '</td></tr>';
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
                html += '<tr><th>Biaya</th><td>Rp. ' + numberFormat(itemData.hrg_sewa_total) + '</td></tr>';
                html += '<tr><th>Pembayaran</th><td>' + textPayment + '</td></tr>';
                html += '<tr><th>Catatan</th><td>' + (itemData.catatan_byr ?? '-') + '</td></tr>';
                html += '<tr><th>Voucher</th><td>' + (itemData.voucher ?? '-') + '</td></tr>';
                if (['2', '4'].includes(itemData.jns_order)) {
                    html += '<tr><th>Penanggung Jawab</th><td>' + (itemData.tg_jwb == '1' ? 'Rental Pemesan' : 'Pelanggan') + '</td></tr>';
                }
                html += '</tbody>';
                html += '</table>';
                html += '</div>';

                // form here
                html += '<div class="mb-3" id="formConfirmOrder"></div>';
                // Add the note text
                // html += '<div class="mb-3"><p class="h6">* ' + textNote + '</p></div>';
                
                // First append the detail table to modal body
                $('#addModal .modal-body').html(html);

                // append form hidden
                const newForm = document.createElement('form'); // Create a new form
                newForm.method = 'POST';
                newForm.id = 'formConfirmOrder';
                newForm.action = '#';
                
                newForm.innerHTML = '<div class="mb-3 align-items-center"><input type="hidden" name="id_order" class="form-control" id="id_order" value="' + idOrder + '"></div>';
                newForm.innerHTML += '<div class="mb-3 align-items-center"><input type="hidden" name="stat_ori" class="form-control" id="stat_ori" value="' + itemData.stat + '"></div>';
                newForm.innerHTML += '<div class="mb-3 align-items-center"><input type="hidden" name="stat" class="form-control" id="stat" value="' + itemData.stat + '"></div>';
                // is_vendor
                newForm.innerHTML += '<div class="mb-3 align-items-center"><input type="hidden" name="is_vendor" class="form-control" id="is_vendor" value="' + is_vendor + '"></div>';
                // is_pemesan
                newForm.innerHTML += '<div class="mb-3 align-items-center"><input type="hidden" name="is_pemesan" class="form-control" id="is_pemesan" value="' + is_pemesan + '"></div>';

                // load
                let resultPlgn = [];
                $.get('<?= base_url('order/detail-order') ?>/' + idOrder, function(data) {
                    let jsonData = JSON.parse(data);
                    // resultPlgn = jsonData.result_plgn[0];
                    // console.log(resultPlgn, 'resultPlgn');

                    let is_readonly = (is_vendor == '1') ? 'readonly' : '';
                    // form pelanggan
                    newForm.innerHTML += '<h6 class="mb-3">Data Marketing Pemesan</h6><div class="list-group mb-3" id="list_plgn"></div>';

                    // loop jml_order
                    for(let i = 0; i < itemData.jml_order; i++){
                        resultPlgn = jsonData.result_plgn[i];
                        console.log(resultPlgn, 'resultPlgn');

                        let nama_plgn = (resultPlgn.nama_plgn || '');
                        let no_hp = (resultPlgn.hp_plgn || '');
                        let ktp_plgn = (resultPlgn.ktp_plgn || '');
                        let note = (resultPlgn.note || '');

                        let html_plgn = `<a href="#" class="list-group-item list-group-item-action">
                        <div class="mb-0 align-items-center">
                            <label class="form-label visually-hidden">Pelanggan</label>
                            <input type="text" name="nama_plgn" class="form-control-plaintext" id="nama_plgn" value="` + nama_plgn + `" ` + is_readonly + ` required>
                        </div>
                        <div class="mb-0 align-items-center">
                            <label class="form-label visually-hidden">No HP</label>
                            <input type="text" name="no_hp" class="form-control-plaintext" id="no_hp" placeholder="No HP" value="` + no_hp + `" ` + is_readonly + `>
                        </div>
                        <div class="mb-0 align-items-center">
                            <label class="form-label visually-hidden">No KTP</label>
                            <input type="text" name="ktp_plgn" class="form-control-plaintext" id="ktp_plgn" placeholder="No KTP" value="` + ktp_plgn + `" ` + is_readonly + `>
                        </div>
                        <div class="mb-0 align-items-center">
                            <label class="form-label visually-hidden">Note</label>
                            <input type="text" name="note" class="form-control-plaintext" id="note" placeholder="Note" value="` + note + `" ` + is_readonly + `>
                        </div></a>`;
                        $('#list_plgn').append(html_plgn);
                    }
                    
                    // form driver
                    newForm.innerHTML += '<h6 class="mb-3">Unit</h6><div class="list-group mb-3" id="list_driver"></div>';
                    // loop jml_order
                    for(let i = 0; i < itemData.jml_order; i++){

                        // if (['2', '4'].includes(itemData.jns_order)) {
                        //     let html_driver = `<li class="list-group-item mb-3">
                        //         <div class="mb-3 align-items-center">
                        //             <label class="form-label visually-hidden">Nopol</label>
                        //             <input type="text" name="nopol_driver[` + i + `]" class="form-control-plaintext" id="nopol_driver" placeholder="Nopol" value="` + (resultPlgn.nopol || '') + `" required>
                        //         </div>
                        //     </div></li>`;

                        //     $('#list_driver').append(html_driver);
                        // } else {
                            let html_driver = `<a href="#" data-bs-toggle="modal" data-bs-target="#driverModal" data-id="` + (i+1) + `" data-item='` + JSON.stringify(resultPlgn) + `' data-order='` + idOrder + `' class="list-group-item list-group-item-action">
                            <div class="mb-0 align-items-center">
                                <label class="form-label visually-hidden">Driver</label>
                                <input type="text" name="nama_driver[` + i + `]" class="form-control-plaintext" id="nama_driver" placeholder="Nama Driver" value="` + (resultPlgn.nama_drv || '') + `" readonly>
                            </div>
                            <div class="mb-0 align-items-center">
                                <label class="form-label visually-hidden">No HP</label>
                                <input type="text" name="no_hp_driver[` + i + `]" class="form-control-plaintext" id="no_hp_driver" placeholder="No HP" value="` + (resultPlgn.hp_drv || '') + `" readonly>
                            </div>
                            <div class="mb-0 align-items-center">
                                <label class="form-label visually-hidden">Nopol</label>
                                <input type="text" name="nopol_driver[` + i + `]" class="form-control-plaintext" id="nopol_driver" placeholder="Nopol" value="` + (resultPlgn.nopol || '') + `" readonly>
                            </div>
                            <div class="mb-0 align-items-center">
                                <label class="form-label visually-hidden">Note</label>
                                <input type="text" name="note_driver[` + i + `]" class="form-control-plaintext" id="note_driver" placeholder="Note" value="` + (resultPlgn.note_drv || '') + `" readonly>
                            </div></a>`;

                            $('#list_driver').append(html_driver);
                        // }
                    }

                    // if(is_vendor == '1'){
                        if(is_pemesan == '1'){
                            newForm.innerHTML += '<h6 class="mb-3">Pembayaran</h6><ul class="list-group mb-3" id="list_pembayaran"></ul>';
                        } else {
                            newForm.innerHTML += `<h6 class="mb-3 d-flex justify-content-between">Pembayaran <span class="pull-right"><a href="#" data-bs-toggle="modal" data-bs-target="#paymentModal" data-id="` + idOrder + `" data-item='` + JSON.stringify(itemData) + `'>Ubah Pembayaran</a></span></h6><ul class="list-group mb-3" id="list_pembayaran"></ul>`;
                        }
                    
                        // newForm.innerHTML += '<h6 class="mb-3">Pembayaran</h6><ul class="list-group" id="list_pembayaran"></ul>';                    
                        let html_pembayaran = `<li class="list-group-item">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>Rp. <span class="pull-right">` + numberFormat(itemData.hrg_sewa_total) + `</span></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>Rp. <span class="pull-right">` + numberFormat(itemData.nominal_disc) + `</span></td>
                                </tr>
                                <tr>
                                    <td>Uang Muka</td>
                                    <td>Rp. <span class="pull-right">` + numberFormat(itemData.nominal_dp || 0) + `</span></td>
                                </tr>
                                <tr class="h6">
                                    <td>Total Tagihan</td>
                                    <td>Rp. <span class="pull-right">` + numberFormat(itemData.hrg_sewa_total - itemData.nominal_dp - itemData.nominal_disc) + `</span></td>
                                </tr>
                                <tr>
                                    <td>Metode Bayar</td>
                                    <td>` + textPayment.toUpperCase() + `</td>
                                </tr>
                                <tr>
                                    <td>Jatuh Tempo</td>
                                    <td>` + (itemData.tgl_tempo || '') + `</td>
                                </tr>
                                <tr>
                                    <td>*Keterangan</td>
                                    <td>` + (itemData.ketr || '') + `</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Bank Tujuan Transfer <br>` + (itemData.norek_rental || '') + `</td>
                                </tr>`;
                                
                        let path_img = "<?= base_url(); ?>proxy.php?url=<?= $_ENV['API_BASEURL']; ?>images_dp/" + encodeURIComponent(itemData.path_foto);
                        // console.log(path_img,'path_img');
                        if(itemData.path_foto) {
                            let link_img = `<img class="avatar avatar-lg" data-url="${path_img}" src="${path_img}" style="width: 64px; height: 64px;" />`;
                            html_pembayaran += `<tr>
                                <td colspan="2">
                                    <div class="d-flex align-items-center">${link_img}</div>
                                </td>
                            </tr>`;
                        }
                                
                        html_pembayaran += `</tbody>
                        </table>
                        </li>`;
                        $('#list_pembayaran').append(html_pembayaran);
                    // }

                    // unggah Dokumen Serah/terima
                    // Is_vendor== 1 && stat ==   9 && jns_order == 2 || jns_order == 4 (selesaikan pelayanan)
                    // reset foto_serah dan foto_terima
                    // itemData.foto_serah = '';
                    // itemData.foto_terima = '';

                    if((is_vendor == '1' || is_pemesan == '1') && itemData.stat == '9'){
                        // instruksi Saat klik Tombol cek :
                        // 1. Sdh pilih nama file penyerahan ato blm, jika blm, kasih notif.
                        // 2. Jika pilih nama file penerimaan, tp nama file penyerahan blm ada, kasih notif klo foto penyerahan blm ada
                        // 3. Klo kedua file sdh ada, tp blm persetujuan blm dicontreng, kasih notif...
                        // 4. Klo sudah persetujuan, klik tombol cek, kasih notif sudah disetujui.
                        // 5. Klo blm ada nama file penyerahan, kasih notif klo foto penyerahan blm ada
                        // 6. Klo ada nama file penyerahan, tp blm ada nama file penerimaan, kasih notif klo foto penerimaan blm ada
                        // 7. Klo ada kedua file, tp blm persetujuan, kasih notif blm disetujui.
                        
                        let foto_serah =  (itemData.foto_serah) ? "<?= base_url(); ?>proxy.php?url=<?= $_ENV['API_BASEURL']; ?>images_lk/" + encodeURIComponent(itemData.foto_serah) : "https://placehold.co/100";

                        let foto_terima = (itemData.foto_terima) ? "<?= base_url(); ?>proxy.php?url=<?= $_ENV['API_BASEURL']; ?>images_lk/" + encodeURIComponent(itemData.foto_terima) : "https://placehold.co/100";

                        let foto_serah_html = `<div class="img-fluid mb-3 text-center">
                            <img class="avatar avatar-lg img-thumbnail foto_serah" data-url="${foto_serah}" src="${foto_serah}" />
                        </div>
                        <label class="form-label visually-hidden">Dokumen Serah Terima</label>
                        <input type="file" name="foto_serah" class="form-control" id="foto_serah" ${itemData.foto_serah ? '' : 'required'}>`;

                        let foto_terima_html = `<div class="img-fluid mb-3 text-center">
                            <img class="avatar avatar-lg img-thumbnail foto_terima" data-url="${foto_terima}" src="${foto_terima}" />
                        </div>
                        <label class="form-label visually-hidden">Dokumen Serah Terima</label>
                        <input type="file" name="foto_terima" class="form-control" id="foto_terima" ${(itemData.foto_serah && !itemData.foto_terima) ? 'required' : ''}>`;

                        if (['2', '4'].includes(itemData.jns_order)) {

                            if(itemData.foto_serah && itemData.foto_serah != 'https://placehold.co/100'){
                                foto_serah_html = `<div class="img-fluid mb-3 text-center">
                                    <img class="avatar avatar-lg img-thumbnail foto_serah" data-url="${foto_serah}" src="${foto_serah}" />
                                </div>`;
                            }

                            if(itemData.foto_terima && itemData.foto_terima != 'https://placehold.co/100'){
                                foto_terima_html = `<div class="img-fluid mb-3 text-center">
                                    <img class="avatar avatar-lg img-thumbnail foto_terima" data-url="${foto_terima}" src="${foto_terima}" />
                                </div>`;
                            }

                            newForm.innerHTML += '<h6 class="mb-3">Dokumen Serah/Terima</h6><ul class="list-group" id="list_dokumen"></ul>';
                            let html_dokumen = `<li class="list-group-item">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3 align-items-center">
                                        ${foto_serah_html}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3 align-items-center">
                                        ${foto_terima_html}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3 align-items-center">
                                        <input type="checkbox" name="check_dokumen" class="form-check-input" id="check_dokumen" checked disabled>
                                        <label class="form-check-label" for="check_dokumen">Pihak Rental telah menyetujui dan menerima pengembalian Unit</label>
                                    </div>
                                </div>
                            </div></li>`;
                            $('#list_dokumen').append(html_dokumen);
                        }
                    }
                });
                
                // Then append the form to the formConfirmOrder div
                $('#formConfirmOrder').html(newForm);

                // append to modal footer
                if(is_vendor == '1'){
                    if (itemData.stat == '9' && (itemData.jns_order == '2' || itemData.jns_order == '4') && (!itemData.foto_serah || !itemData.foto_terima)) {
                        $('#addModal .modal-footer').html(`
                            <button type="submit" class="btn btn-primary w-100 btnConfirmOrder" data-action="selesai">UNGGAH FOTO PENYERTAAN UNIT</button>
                        `);
                    } else {
                        $('#addModal .modal-footer').html(`
                            <button type="submit" class="btn btn-primary w-100 btnConfirmOrder" data-action="selesai">SELESAIKAN PELAYANAN</button>
                        `);
                    }
                } else {
                    $(document).find('#addModal .modal-footer').html(`
                        <button type="submit" class="btn btn-primary w-100 btnConfirmOrder" data-action="selesai">BERI PENILAIAN</button>
                    `);
                }

                $('#addModal').modal('show');
            }
        });

        $(document).on('click', 'button.btnConfirmOrder', function(e) {
            e.preventDefault();
            let action = $(this).data('action');
            console.log(action, 'action');
            
            let form = $('#formConfirmOrder form'); // Get the actual form element inside #formConfirmOrder
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

            // Validate all fields
            let isValid = true;
            let errors = [];
            let alasan_batal = form.find('textarea#alasan_batal').val();
            
            if(action == 'batal' && !alasan_batal) {
                // remove all class required from input
                form.find('input').removeAttr('required');
                
                // Remove any existing alasan_batal field to prevent duplicates
                form.find('#alasan_batal').closest('.mb-3').remove();
                
                // Add the alasan_batal textarea
                form.append(`
                    <div class="mt-3 mb-3 align-items-center">
                        <label class="form-label">Alasan Pembatalan</label>
                        <textarea name="alasan_batal" class="form-control" id="alasan_batal" placeholder="Keterangan" required></textarea>
                    </div>
                `);

                // Clear previous validation rules and set new ones for cancellation
                baseValidationRules = [
                    { field: 'id_order', message: 'Order data is missing' },
                    { field: 'stat_ori', message: 'Order data is missing' },
                    { field: 'alasan_batal', message: 'Reason for rejection is required' }
                ];
                
                // return false; // Stop form submission to allow user to enter reason
            } else {

                if (action == 'terima' && is_vendor == '1') {
                    baseValidationRules.push({ field: 'nama_driver', message: 'Driver name is required' });
                    baseValidationRules.push({ field: 'nopol_driver', message: 'Vehicle plate number is required' });
                }
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

            // If validation passes, create FormData from the actual form element
            let formData = new FormData(form[0]);
            // push stat
            formData.append('action', action);

            // If validation passes, continue with form submission
            $.ajax({
                url: '<?= base_url('proses/confirm') ?>',
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

        // driverModal
        $('#driverModal').on('show.bs.modal', function (e) {
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                let idDriver = triggerElement.dataset.id;
                let idOrder = triggerElement.dataset.order;
                // Parse JSON string into an object
                let driverData = JSON.parse(triggerElement.dataset.item); // Decoding JSON
                console.log(driverData, '_driverData');

                // nama_driver
                let nama_driver = (driverData.nama_drv || '');
                $('#driverModal').find('#nama_driver').val(nama_driver);

                // no_hp_driver
                let no_hp_driver = (driverData.hp_drv || '');
                $('#driverModal').find('#no_hp_driver').val(no_hp_driver);

                // nopol_driver
                let nopol_driver = (driverData.nopol || '');
                $('#driverModal').find('#nopol_driver').val(nopol_driver);

                // note_driver
                let note_driver = (driverData.note_drv || '');
                $('#driverModal').find('#note_driver').val(note_driver);

                // id_driver hidden
                $('#driverModal').find('#id_order').val(idOrder);
                // no hidden
                $('#driverModal').find('#no').val(idDriver);
            }
        });

        // btnDriverSave
        $('#driverModal').on('click', 'button.btnDriverSave', function(e) {
            e.preventDefault();
            console.log('btnDriverSave');

            let form = $('#formDriver');
            let formData = new FormData(form[0]);
            
            // submit form
            $.ajax({
                url: '<?= base_url('inbox/ubahDriver') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    let data = JSON.parse(response);
                    if (data.success) {
                        // close modal
                        $('#driverModal').modal('hide');
                        localStorage.setItem("openModal", "true");
                        location.reload(); // Reload halaman
                        // open addModal
                        // $('#addModal').modal('show');
                    } else {
                        // show error
                        console.log(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // paymentModal
        $('#paymentModal').on('show.bs.modal', function (e) {
            $('#addModal').modal('hide');
            let triggerElement = e.relatedTarget;
            if (triggerElement) {
                let idOrder = triggerElement.dataset.id;
                // Parse JSON string into an object
                let itemData = JSON.parse(triggerElement.dataset.item);
                console.log(itemData, 'itemData');

                // Hapus instance datepicker sebelumnya agar tidak terjadi duplikasi
                $('#tgl_tempo').datepicker('destroy');

                // Inisialisasi datepicker
                $('#tgl_tempo').datepicker({
                    format: 'dd-mm-yyyy',
                    uiLibrary: 'bootstrap5',
                    autoclose: true
                });
                
                // jns_byr
                let jns_byr = itemData.jns_byr;
                if(jns_byr == '1'){
                    $('#paymentModal').find('#inlineRadio1').prop('checked', true).trigger('change');
                } else {
                    $('#paymentModal').find('#inlineRadio2').prop('checked', true).trigger('change');
                }

                // over_time
                let biaya_1 = (itemData.biaya_1 || 0);
                $('#paymentModal').find('#biaya_1').val(biaya_1);

                // tol_parkir
                let biaya_2 = (itemData.biaya_2 || 0);
                $('#paymentModal').find('#biaya_2').val(biaya_2);

                // lain_lain
                let biaya_3 = (itemData.biaya_3 || 0);
                $('#paymentModal').find('#biaya_3').val(biaya_3);

                // nominal_byr
                let nominal_byr = (itemData.nominal_dp || 0);
                $('#paymentModal').find('#nominal_byr').val(nominal_byr);

                // tgl_jatuh_tempo
                let tgl_tempo = (itemData.tgl_tempo || '');
                // Konversi format tanggal dari YYYY-MM-DD ke DD-MM-YYYY
                var parts = tgl_tempo.split('-');
                var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0]; // DD-MM-YYYY
                $('#paymentModal').find('#tgl_tempo').val(formattedDate);

                // diskon
                let nominal_disc = (itemData.nominal_disc || 0);
                $('#paymentModal').find('#nominal_disc').val(nominal_disc);
                
                // keterangan
                let ketr_byr = (itemData.ketr_byr || '');
                $('#paymentModal').find('#ketr_byr').val(ketr_byr);
                
                // total_tagihan
                let hrg_sewa_total = (itemData.hrg_sewa_total - itemData.nominal_dp - itemData.nominal_disc || 0);
                $('#paymentModal').find('#total_tagihan').html(numberFormat(hrg_sewa_total));

                // id_order hidden
                $('#paymentModal').find('#id_order').val(idOrder);
            }
        });

        // btnPaymentSave
        $(document).on('click', 'button.btnPaymentSave', function(e) {
            e.preventDefault();
            console.log('btnPaymentSave');

            let form = $('#formPayment');
            let formData = new FormData(form[0]);
            // tambahkan is_pemesan, is_vendor
            formData.append('is_pemesan', is_pemesan);
            formData.append('is_vendor', is_vendor);
            // submit form
            $.ajax({
                url: '<?= base_url('inbox/ubahPayment') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    let data = JSON.parse(response);
                    if (data.success) {
                        // close modal
                        $('#paymentModal').modal('hide');
                        // open addModal
                        // $('#addModal').modal('show');
                    } else {
                        // show error
                        console.log(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

    });

    // $(".container").imageBox();
    $(document).on('click', 'img.avatar', function(e) {
        $('#imgViewer').html('').append(
            $(e.currentTarget).clone()
                .removeAttr('style')
                .attr('style', 'width:100%') // Add width:100% style
                .addClass('img-fluid')
        );
        $('#viewImg').modal('show');
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

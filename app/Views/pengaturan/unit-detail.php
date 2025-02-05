<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <?php include_once '_alert.php'; ?>
        
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('pengaturan/unit') ?>" class="btn">
                        <i class="fa fa-arrow-left"></i> Unit
                    </a>
                </div>
                <div class="card-body">                    
                    <form action="<?= base_url('pengaturan/unit') ?>" method="POST">
                    <?php 
                    // echo json_encode($listData); 
                    include_once '_form_unit.php';
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

    <?php include_once '_modal_harga_unit.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-clustering.js"></script>
<script>
    $(document).ready(function() {

        // $.fn.modal.Constructor.prototype._enforceFocus = function () {};
        const baseUrlImg    = "<?= base_url('proxy.php?url=' . $_ENV['API_BASEURL'] . 'images/') ?>";
        const listKategori  = '<?= json_encode($listKategori['result_kategori']) ?>';
        const listPaketBbm  = '<?= json_encode($listPaketBbm['result_bbm']) ?>';
        const listData      = '<?= json_encode($listData['result_unit']) ?>';

        $('#kategori').select2({
            theme: 'bootstrap-5',
            placeholder: 'Type to search...',
            minimumInputLength: 2,
            data: listKategori
        });

        $('#bbm').select2({
            theme: 'bootstrap-5',
            placeholder: 'Type to search...',
            minimumInputLength: 2,
            data: listPaketBbm
        });

        function initForm(){
                
            // get data-item
            // var item = JSON.parse(event.relatedTarget.dataset.item);
            var item = JSON.parse(listData)[0];
            console.log(item, '81_item');

            // set value into form
            $('#nama').val(item.nama);
            // $('#kategori option').filter(function() {
            //     return $(this).text() == item.kategori;
            // }).prop("selected", true);
            // $("#bbm option").filter(function() {
            //     return $(this).text() == item.bbm;
            // }).prop("selected", true);

            $('#kategori').select2("trigger", "select", {
                data: { id: item.kategori, text: item.kategori }
            });
            $('#bbm').select2("trigger", "select", {
                data: { id: item.bbm, text: item.bbm }
            });

            $('#kursi').val(item.kursi);
            $('#tahun').val(item.tahun);
            $('#transmisi').val(item.transmisi);
            $('#warna').val(item.warna);
            $('#jarak_tempuh').val(item.jarak_tempuh);
            $('#dlm_kota').val(item.dlm_kota);
            $('#dlm_prop').val(item.dlm_prop);
            $('#luar_prop').val(item.luar_prop);
            $('#drop_in').val(item.drop_in);
            $('#over_time').val(item.over_time);
            $('#stgh_hr').val(item.stgh_hr);
            $('#fee').val(item.fee);
            $('#lepas_kunci').val(item.lepas_kunci);
            $('#bulanan').val(item.bulanan);

            if (item.path_foto && item.path_foto.length > 0) {
                $("#path_foto").attr("src", baseUrlImg + item.path_foto);
            }
            if (item.path_foto_2 && item.path_foto_2.length > 0) {
                $("#path_foto_2").attr("src", baseUrlImg + item.path_foto_2);
            }
            if (item.path_foto_3 && item.path_foto_3.length > 0) {
                $("#path_foto_3").attr("src", baseUrlImg + item.path_foto_3);
            }
            if (item.path_foto_4 && item.path_foto_4.length > 0) {
                $("#path_foto_4").attr("src", baseUrlImg + item.path_foto_4);
            }

            if(item.stat == 0){
                $('#stat').val(item.stat).prop('checked', false);
            } else {
                $('#stat').val(item.stat).prop('checked', true);
            }

            $('#biaya_antar').val(item.biaya_antar);
            $('#biaya_ambil').val(item.biaya_ambil);
            $('#tuslah').val(item.tuslah);
            $('#is_tuslah').val(item.is_tuslah);
            $('#kons_bbm').val(item.kons_bbm);

            // append id into form class modal-body
            // if name id is exist, then set value id
            if($('.modal-body input[name="id"]').length > 0){
                $('.modal-body input[name="id"]').val(item.kode);
            } else {
                // append id into form class modal-body
                $('.modal-body').append('<input type="hidden" name="id" value="' + item.kode + '">');
            }
        };

        initForm();

        var listTujuan = [];
        // Initialize Select2
        $('#lokasiJemput, #lokasiTujuan').select2({
            theme: 'bootstrap-5',
            placeholder: 'Type to search...',
            minimumInputLength: 3,
            ajax: {
                url: '<?= $_ENV['API_BASEURL_HERE'] ?>/autocomplete',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // Search term
                        limit: 5,      // Limit results
                        in: 'countryCode:IDN',
                        apiKey: '<?= $_ENV['API_KEY_HERE'] ?>'
                    };
                },
                processResults: function (data) {
                    console.log(data.items);
                    listTujuan = data.items.map(item => ({
                        id: item.title,
                        text: item.title.substr(item.title.lastIndexOf(",") + 1)
                    }));

                    return {
                        more: false,
                        results: listTujuan
                    };
                },
                cache: true
            }, 
            onSelect: function(e) {
                // console.log(e);
                var data = e.params.data;
                console.log(data);
            }, 
            data: listTujuan
        }).on('change', function() {
            // console.log($('#lokasiJemput').val());
        });        

        $('#lokasiTujuan').on('change', async function() {
            let lokasiJemput = $('#lokasiJemput').val();
            let lokasiTujuan = $('#lokasiTujuan').val();

            // Validasi input, tidak boleh kosong
            if (lokasiJemput=='' || lokasiTujuan=='') {
                alert('Lokasi Jemput dan Tujuan tidak boleh kosong.');
                return;
            }

            // if not exists, then push to lokasiJemputArr
            if(!lokasiJemputArr.includes(lokasiJemput)) {
            lokasiJemputArr.push(lokasiJemput);
            }
            console.log(lokasiJemputArr, 'lokasiJemputArr');

            // if not exists, then push to lokasiTujuanArr
            if(!lokasiTujuanArr.includes(lokasiTujuan)) {
            lokasiTujuanArr.push(lokasiTujuan);
            }
            console.log(lokasiTujuanArr, 'lokasiTujuanArr');

            // set value to input
            $('input[name="origins[]"]').val(lokasiJemputArr);
            $('input[name="destinations[]"]').val(lokasiTujuanArr);

            const rute = `${lokasiJemput.substr(lokasiJemput.lastIndexOf(",") + 1)} - ${lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1)}`;

            // Cek apakah rute sudah ada di daftar
            let ruteSudahAda = false;
            $('#listRute li').each(function() {
                if ($(this).text() === rute) {
                    ruteSudahAda = true;
                    return false; // Hentikan iterasi
                }
            });

            if (ruteSudahAda) {
                console.log('Rute sudah ada di daftar.');
                // set lokasi jemput with tujuan
                $('#lokasiJemput').select2("trigger", "select", {
                data: { id: lokasiTujuan, text: lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1) }
                });
                // reset lokasi tujuan
                $('#lokasiTujuan').select2("trigger", "select", {
                data: { id: '', text: '' }
                });
            } else {
                if(lokasiJemput=='' || lokasiTujuan=='') return false;

                // Tambahkan rute ke daftar
                $('#listRute').append(`<li class="list-group-item">${rute}</li>`);

                // hitung jarak
                hitungJarak(lokasiJemput, lokasiTujuan).then(jarak => {
                    console.log(jarak, '182_jarak');
                    $('#jarak').val(jarak / 1000); // Convert to kilometers
                });
            }
        });

        // modal-2
        const baseValidationRules = [
            { field: 'lokasiJemput', message: 'Lokasi Jemput harus dipilih' },
            { field: 'lokasiTujuan', message: 'Lokasi Tujuan harus dipilih' }
        ];

        $('#hargaModal').on('show.bs.modal', function (event) {
            console.log(event.relatedTarget.dataset.id);
            $(this).find('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $('#hargaModal')
                });
            });
        });

        $(document).find('#lokasiTujuan2').on('change', async function() {
            let lokasiJemput = $('#lokasiJemput2').val();
            let lokasiTujuan = $('#lokasiTujuan2').val();
            console.log('lokasiJemput2 = ' + lokasiJemput + ', lokasiTujuan2 = ' + lokasiTujuan);
        });

        $(document).on('click', '#btnHitung', function() {
            let wilayah = $('input[name="wilayah"]:checked').val();
            let lokasiJemput = $(document).find('#lokasiJemput').val();
            let lokasiTujuan = $(document).find('#lokasiTujuan').val();
            
            console.log('wilayah = ' + wilayah + ', lokasiJemput = ' + lokasiJemput + ', lokasiTujuan = ' + lokasiTujuan);

            // Validate all fields
            let isValid = true;      
            let validationRules = [...baseValidationRules]; // Copy base rules
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
        });

        $(document).on('click', '#btnHitung', function() {
            // $('#formHargaUnit').submit();
        });
    });
</script>
<?= $this->endSection() ?>
    <?php //echo json_encode($listBerita); ?>
    <!-- Blogs -->
    <!-- <div class="row mb-3">
        <div class="col">
            <h6 class="title">Berita</h6>
        </div>
        <div class="col-auto align-self-center">
            <a href="/#" class="small">Read more</a>
        </div>
    </div> -->
    <div class="row">
        <ul class="list-group">
            <li class="list-group-item active">Berita</li>
            <?php foreach($listBerita['result_news'] as $berita): ?>
            <li class="list-group-item">    
                <a href="/#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-item="<?= esc(json_encode($berita)) ?>">
                    <p><strong><?= date('d-m-Y', strtotime($berita['tgl'])) . ' ' . $berita['header'] ?></strong></p>
                    <span><?= substr($berita['detail'], 0, 40) . '...' ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
            </div>
        </div>
    </div>

    <?= $this->section('styles') ?>
    <style>
        .list-group-item {
            font-size: 13px;
            cursor: pointer;
        }
    </style>
    <?= $this->endSection() ?>
    <?= $this->section('scripts') ?>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {                
            // get data-item
            var item = JSON.parse(event.relatedTarget.dataset.item);
            console.log(item, 'item');
            // Update the modal's content. We'll use jQuery here, but it's not required.
            var modal = $(this)
            // var dateIndo = new Date(item.tgl).toLocaleString().split(',')[0] // format dd-mm-yyyy
            // Format the date as dd-mm-yyyy
            var formattedDate = formatDateIndo(item.tgl);

            modal.find('.modal-title').text(formattedDate + ' ' + item.header)
            modal.find('.modal-body').html(nl2br(item.detail))
        })

        function formatDateIndo(date) {
            var date = new Date(date);
            var day = String(date.getDate()).padStart(2, '0'); // Ensure two digits
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            var year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function nl2br (str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
    </script>
    <?= $this->endSection() ?>

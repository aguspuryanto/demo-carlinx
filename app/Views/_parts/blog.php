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
                    <p><strong><?= $berita['tgl'] . ' ' . $berita['header'] ?></strong></p>
                    <span><?= substr($berita['detail'], 0, 40) . '...' ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog" style="position: fixed; bottom: 0;">
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

    <?= $this->section('scripts') ?>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {                
            // get data-item
            var item = JSON.parse(event.relatedTarget.dataset.item);
            console.log(item, 'item');
            // Update the modal's content. We'll use jQuery here, but it's not required.
            var modal = $(this)
            modal.find('.modal-title').text(item.tgl + ' ' + item.header)
            modal.find('.modal-body').html(item.detail)
        })
    </script>
    <?= $this->endSection() ?>

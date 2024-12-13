<?php
helper('form');
?>

<?= form_open('rate/hitung', []); ?>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Nama Unit</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Avanza 2017 (Test)</option>
      <option>Avanza 2020 (Test)</option>
      <option>Avanza TSS (Test)</option>
      <option>Big Bus (Test)</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
</form>

<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?>
<script>
    $(function () {
      // 
    });
</script>
<?= $this->endSection() ?>
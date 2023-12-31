<?= $this->extend('template/content'); ?>

<?php $this->section('content') ?>
<div class="section">
  <div class="row">
    <div class="col-md-12">

      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card shadow">
            <?php if (session('role') === 'Admin') : ?>
              <div class="d-flex justify-content-between px-3 pt-4">
                <h1 class="jdl"><?= $judul; ?></h1>
                <a href="/sub-kriteria/create" class="btn btn-tambah tbh"><i class="fas fa fa-plus"></i> Tambah</a>
              </div>
              <div class="card-header d-flex justify-content-end">
                <button class="btn btn-hapus hps"><i class="fas fa fa-trash-alt"></i> Hapus</button>
                <button class="btn btn-ubah ubh"><i class="fas fa fa-edit"></i> Ubah</button>
              </div>
            <?php endif; ?>
            <div class="card-body">
              <table class="table table-bordered table-striped table-subkriteria" id="example">
                <thead>
                  <th>
                    <input type="checkbox" id="checkboxes">
                  </th>
                  <th>No.</th>
                  <th>Kriteria</th>
                  <th>Sub-Kriteria</th>
                  <th>Nilai Preferensi</th>
                </thead>
                <tbody>
                  <?php if ($subkriteria) : ?>
                    <?php $nomor = 1; ?>
                    <?php foreach ($subkriteria->getResultArray() as $key => $row) : ?>
                      <tr>
                        <td>
                          <input type="checkbox" name="id[]" class="checkbox" value="<?= $row['id_sub_kriteria']; ?>">
                        </td>

                        <?php if ($rowspan[$row['nama_kriteria']]['printed'] == 'yes') : ?>
                          <td rowspan="<?= $rowspan[$row['nama_kriteria']]['rowspan'] ?>"><?= $nomor; ?></td>
                          <td rowspan="<?= $rowspan[$row['nama_kriteria']]['rowspan'] ?>"><?= $row['nama_kriteria']; ?></td>

                          <?php $rowspan[$row['nama_kriteria']]['printed'] = 'no' ?>
                        <?php else : ?>
                          <?php $nomor -= 1; ?>
                        <?php endif; ?>

                        <td><?= $row['nama']; ?></td>
                        <?php $nomor++ ?>
                        <td><?= $row['nilai_preferensi']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="5" class=" text-gray-900 text-center">
                        <h3>DATA BELUM ADA</h3>
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal Ubah -->
      <div class="modal fade" id="modalBoxUbah" tabindex="-1" role="dialog" aria-labelledby="modalBoxUbahTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="d-flex justify-content-between">
              <div class="judul-1">
                <h1>Edit Data</h1>
                <p>Form untuk edit data yang tersimpan terkait halaman ini!</p>
              </div>
              <div class="img-judul">
                <center> <img src="<?= base_url() ?>/img/mail.png" class="card-img-top mt-2"></center>
              </div>
            </div>

            <form action="/subkriteria/update" method="POST" class="formSubmit" id="formUbah">
              <div class="modal-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_sub_kriteria" id="id_ubah">
                <div class="form-group">
                  <label for="nama_ubah">Nama</label>
                  <input type="text" name="nama" id="nama_ubah" class="form-control" placeholder="Sub kriteria..">
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="nilai_preferensi_ubah">Nilai Preferensi</label>
                  <input type="text" name="nilai_preferensi" id="nilai_preferensi_ubah" class="form-control" placeholder="Sub kriteria..">
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-simpan submit"><i class="fas fa fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('custom-js'); ?>
<script>
  $(document).ready(function() {

    $('.btn-hapus').on('click', function() {
      requestDeleteData('/subkriteria/delete')
    })

    $('.btn-ubah').on('click', function(e) {
      requestGetDataById('/subkriteria/getDataById')
    })

    const formUbah = $('#formUbah')
    formUbah.submit(function(e) {
      e.preventDefault()

      requestSaveData(formUbah, '#modalBoxUbah')

      removeClasses(formUbah)
    })
  })
</script>

<?php $this->endSection(); ?>